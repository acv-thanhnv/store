<?php

namespace App\Api\V1\Http\Controllers;
use App\Api\V1\Services\Interfaces\KitchenServiceInterface;
use App\Core\Common\OrderConst;
use App\Core\Common\OrderStatusValue;
use App\Core\Common\SDBStatusCode;
use App\Core\Entities\DataResultCollection;
use App\Core\Events\OrderPusherEvent;
use App\Core\Helpers\CommonHelper;
use App\Core\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class KitchenController extends Controller
{
	protected $kitchenService;
    public function __construct(KitchenServiceInterface $kitchenService)
    {
        $this->service = $kitchenService;
    }

    public function test1(Request $request) {
    	$data = $this->service->getFoodByOrderAll($request);
    	// return response()->json($data);
    	return $data;
	}

	public function test(Request $request) {
    	$data = $this->service->getPriorityByOrder($request);
    	return response()->json($data);
	}

    public function showPriorityByOrder(Request $request) {
    	$data = $this->service->getPriorityByOrder($request);
    	return response()->json($data);
	}

    public function showOrderDetail(Request $request) {
    	$order = $this->service->getOrderLocationByStore($request);
		$details = $this->service->getFoodByOrderAll($request);
		$data = [
			'storeId' => $request->storeId,
			'orders' => $order,
			'details' => $details
		];
		return response()->json($data);
	}

    public function showOrderLocationByStore(Request $request) {
		$data = $this->service->getOrderLocationByStore($request);
		return response()->json($data);
	}

	public function showFoodQueue(Request $request) {
		$data = $this->service->getFoodQueue($request);
		return response()->json($data);	
	}

	public function showFoodByOrder(Request $request) {
		$data = $this->service->getFoodByOrder($request);
		return response()->json($data);	
	}

    public function showFoodByStore(Request $request) {
		$data = $this->service->getFoodByStore($request);
		return response()->json($data);	
	}

	public function showLocationbyOrder(Request $request) {
		$data = $this->service->getLocationByOrder($storeId, $orderId);
		return response()->json($data);	
	}

	public function orderStatus($storeId, $orderId) {
		$list = DB::table('store_order')
		->join('store_location', 'store_order.location_id', '=','store_location.id')
		->select('store_order.id','store_location.name')
		->where('store_order.status',2)
		->get();

		$detail = DB::table('store_order')
		->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
		->join('store_entities', 'store_entities.id', '=','store_order_detail.entities_id')
		->select('store_entities.name','store_order_detail.quantity','store_order_detail.cooked')
		->where('store_order.status',2)
		->where('store_order.id',$orderId)
		->get();

		$data = [
			'list' => $list,
			'detail' => $detail
		];

		return response()->json($data);
	}

	public function showQueue($storeId) {
		$data = DB::table('store_order')
		->join('store_order_status', 'store_order_status.id', '=','store_order.status')
		->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
		->join('store_entities', 'store_entities.id', '=','store_order_detail.entities_id')
		->selectRaw('store_entities.name as name, sum(quantity) as quantity')
		->where('store_order.store_id',$storeId)
		->where('store_order.status',2)
		->groupBy('entities_id')
		->get();
		return response()->json($data);
	}
}
