<?php

namespace App\Manager\Http\Controllers;

use App\Core\Common\OrderConst;
use App\Core\Common\FoodStatusValue;
use App\Core\Common\OrderStatusValue;
use App\Core\Events\Customer2CashierPusher;
use App\Core\Events\PaymentDonePusher;
use App\Core\Events\RollbackCashierPusher;
use App\Core\Events\Other2OrderManagerPusher;

use Illuminate\Http\Request; 
use Pusher\Pusher;
use Illuminate\Support\Facades\DB;

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

		for ($i=0; $i<count($listOrderId); $i++) {
			$rollback = DB::table('store_rollback_cashier')->insert(
				[
					'store_id' => $storeId,
					'order_id' => $listOrderId[i],
					'before_status' => $listBeforeStatus[i]
				]
			);

			$orderDetails = DB::table('store_order')
			->join('store_location', 'store_order.location_id', '=','store_location.id')
			->join('store_type_location', 'store_location.type_location_id', '=','store_type_location.id')
			->join('store_order_status', 'store_order_status.value', '=','store_order.status')
			->select('store_order.id', 'store_order.status', 'store_order.access_token', 'store_order.store_id', 'store_order.datetime_order', 'store_order.datetime_update', 'store_order.location_id', 'store_location.name as table_name', 'store_order.priority', 'store_type_location.name as type_name', 'store_order_status.name as status_name')
			->where('store_order.store_id',$storeId)
			->where('store_order.id',$orderId)
			->get();

			event(new Other2OrderManagerPusher($storeId, $orderDetails[0], null) );
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

		if ($res&&$res2) event(new RollbackCashierPusher($storeId));
		return $res;
	}
}