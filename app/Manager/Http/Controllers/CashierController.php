<?php

namespace App\Manager\Http\Controllers;
use App\Core\Common\FoodStatusValue;
use App\Core\Common\OrderConst;
use App\Core\Common\OrderStatusValue;
use App\Core\Dao\SDB;
use App\Core\Events\Customer2CashierPusher;
use App\Core\Events\OrderStatusPusherEvent;
use App\Core\Events\Other2OrderManagerPusher;
use App\Core\Events\PaymentDonePusher;
use App\Core\Events\RollbackCashierPusher;
use App\Core\Events\TableEvent;
use App\Core\Helpers\CommonHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class CashierController extends Controller
{
	public function index($storeId) {
		return view('frontend/cashier3/index', [
			'storeId' => $storeId,
			'WaiterToWaiterChannel' => OrderConst::WaiterToWaiterChannel,
			'Customer2Order' => OrderConst::Customer2Order,
			'Order2Cashier' => OrderConst::Order2Cashier,
			'Order2Kitchen' => OrderConst::Order2Kitchen,
			'Order2Other' => OrderConst::Order2Other
		]);
	}

	public function paymentDoneByOrder(Request $request) {
		$storeId = $request->storeId;
		$listOrderId = $request->listOrderId;
		$listBeforeStatus = $request->listBeforeStatus;
		$res = DB::table('store_order')
		->where('store_order.store_id', $storeId)
		->whereIn('store_order.id', $listOrderId)
		->update(['store_order.status' => OrderStatusValue::Pay ]);

		$i=0;

		for ($i=0; $i<count($listOrderId); $i++) {
			$orderId = $listOrderId[$i];
			$rollback = DB::table('store_rollback_cashier')->insert(
				[
					'store_id' => $storeId,
					'order_id' => $listOrderId[$i],
					'before_status' => $listBeforeStatus[$i]
				]
			);

			$orderDetails = DB::table('store_order')
			->join('store_location', 'store_order.location_id', '=','store_location.id')
			->join('store_type_location', 'store_location.type_location_id', '=','store_type_location.id')
			->join('store_order_status', 'store_order_status.value', '=','store_order.status')
			->select('store_order.id', 'store_order.status', 'store_order.access_token', 'store_order.store_id', 'store_order.datetime_order', 'store_order.datetime_update', 'store_order.location_id', 'store_location.name as table_name', 'store_order.priority', 'store_type_location.name as type_name', 'store_order_status.name as status_name')
			->where('store_order.store_id',$storeId)
			->where('store_order.id',$listOrderId[$i])
			->get();

			$location_id  = $orderDetails[0]->location_id;
			$access_token = $orderDetails[0]->access_token;

			//event ẩn order ở order đi
			event(new Other2OrderManagerPusher($storeId, $orderDetails[0], null) );
			//call event bind table color
			event(new TableEvent($storeId,$location_id));
			//event clear local storage của cus
			event(new OrderStatusPusherEvent($access_token,$orderId,null,1,null));
		}

		if ($res) {
			event(new PaymentDonePusher($storeId, $listOrderId, $listBeforeStatus));
			/*event(new Other2OrderManagerPusher($storeId,$orderDetails[0],null));*/
		}
		return $res;
	}

	public function rollbackPayment(Request $request) {
		$storeId = $request->storeId;
		$orderId = $request->orderId;
		$status = $request->status;

		$res = DB::table('store_order')
		->where('store_id', $storeId)
		->where('id', $orderId)
		->update(['status' => $status ]);

		$res2 = DB::table('store_rollback_cashier')
		->where('store_id', $storeId)
		->where('order_id', $orderId)
		->delete();

		$arrOrder = SDB::table('store_order as order')
		->join('store_order_status as status','status.value','=','order.status')
		->where('order.id',$orderId)
		->select('order.*','status.name as status_name')
		->get();

		$arrOrderDetail = SDB::table('store_order_detail')
		->join('store_entities','store_order_detail.entities_id','=','store_entities.id')
		->join('store_order_detail_status','store_order_detail_status.value','=','store_order_detail.status')
		->select('store_order_detail.*','store_entities.name','store_entities.image','store_entities.price','store_order_detail_status.status_name')
		->where('store_order_detail.order_id',$orderId)
		->get();
		foreach($arrOrderDetail as $obj){
			$obj->src = CommonHelper::getImageSrc($obj->image);
		}

		if ($res&&$res2) {
			event(new RollbackCashierPusher($storeId));
			//call pusher when order, status food change
			event(new OrderStatusPusherEvent($arrOrder[0]->access_token,$arrOrder[0],$arrOrderDetail,null,OrderConst::has_rollBack));
        	//call event send to Order
			event(new Other2OrderManagerPusher($storeId,$arrOrder[0],$arrOrderDetail));
        	//call event bind table color
			event(new TableEvent($storeId,$arrOrder[0]->location_id));
		}
		return $res;
	}
}