<?php

namespace App\Api\V1\Services\Production;

use App\Api\V1\Services\Interfaces\KitchenServiceInterface;
use App\Core\Common\OrderConst;
use App\Core\Common\OrderStatusValue;
use App\Core\Common\SDBStatusCode;
use App\Core\Dao\SDB;
use App\Core\Entities\DataResultCollection;
use App\Core\Events\OrderChefPusherEvent;
use App\Core\Events\OrderPusherEvent;
use App\Core\Helpers\CommonHelper;
use Illuminate\Http\Request;

class KitchenService extends BaseService implements KitchenServiceInterface
{
    public function getPriorityByOrder(Request $request)
    {
        $storeId = $request->storeId;
        $orderId = $request->orderId;
        $priority = SDB::table('store_order')
        ->select('store_order.priority','store_order.description')
        ->where('store_order.store_id',$storeId)
        ->where('store_order.id',$orderId)
        ->whereIn('store_order.status',[1,2])
        ->get();
        return $priority;
    }

    public function getFoodByStore(Request $request)
    {
        $storeId = $request->storeId;
        $entity = SDB::table('store_order')
        ->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
        ->join('store_entities', 'store_entities.id', '=','store_order_detail.entities_id')
        ->select('store_entities.name','store_order.id','store_order.priority','store_order_detail.quantity')
        ->where('store_order.store_id',$storeId)
        ->whereIn('store_order.status',[1,2])
        ->get();
        return $entity;
    }

    public function getFoodByOrder(Request $request)
    {
        $storeId = $request->storeId;
        $orderId = $request->orderId;
        $details = SDB::table('store_order')
        ->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
        ->join('store_entities', 'store_entities.id', '=','store_order_detail.entities_id')
        ->select('store_entities.id','store_entities.name','store_order_detail.quantity','store_order_detail.cooked')
        ->where('store_order.store_id',$storeId)
        ->where('store_order.id',$orderId)
        ->whereIn('store_order.status',[1,2])
        ->get();
        return $details;
    }

    public function getFoodByOrderChild($storeId, $orderId) {
        $details = SDB::table('store_order')
        ->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
        ->join('store_entities', 'store_entities.id', '=','store_order_detail.entities_id')
        ->select('store_entities.id','store_entities.name','store_order_detail.quantity','store_order_detail.cooked')
        ->where('store_order.store_id',$storeId)
        ->where('store_order.id',$orderId)
        ->whereIn('store_order.status',[1,2])
        ->whereRaw('store_order_detail.quantity > store_order_detail.cooked')
        ->get();
        return $details;
    }

    public function getListOrdersByStore(Request $request) {
        $storeId = $request->storeId;
        $listOrder = SDB::table('store_order')
        ->join('store_location', 'store_order.location_id', '=','store_location.id')
        ->select('store_order.id')
        ->where('store_order.store_id',$storeId)
        ->whereIn('store_order.status',[1,2])
        ->orderBy('store_location.type_location_id', 'desc')
        ->orderBy('store_order.datetime_order', 'asc')
        ->orderBy('store_order.datetime_update', 'asc')
        ->get();
        return $listOrder;
    }

    public function getFoodByOrderAll(Request $request)
    {
        $storeId = $request->storeId;
        $listOrder = $this->getListOrdersByStore($request);
        $data = [];
        foreach ($listOrder as $item) {
            array_push($data, $this->getFoodByOrderChild($storeId, $item->id));
        }
        return $data;
    }

    public function getOrderDetail(Request $request)
    {
        $storeId = $request->storeId;
        $orderId = $request->orderId;
        $entity = SDB::table('store_order')
        ->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
        ->join('store_entities', 'store_entities.id', '=','store_order_detail.entities_id')
        ->select('store_entities.id','store_entities.name','store_order_detail.quantity','store_order_detail.cooked')
        ->where('store_order.store_id',$storeId)
        ->where('store_order.id',$orderId)
        ->whereIn('store_order.status',[1,2])
        ->get();
        $data = [
            'orderId' => $orderId,
            'details' => $entity
        ];
        return $data;
    }

    public function getOrderLocationByStore(Request $request)
    {
        $storeId = $request->storeId;
        $location = SDB::table('store_order')
        ->join('store_location', 'store_order.location_id', '=','store_location.id')
        ->join('store_type_location', 'store_location.type_location_id', '=','store_type_location.id')
        ->join('store_floor', 'store_location.floor_id', '=','store_floor.id')
        ->selectRaw('store_order.id, store_location.name as name, store_floor.name as floor, store_type_location.name as priority, store_order.datetime_order')
        ->where('store_order.store_id',$storeId)
        ->whereIn('store_order.status',[1,2])
        ->orderBy('store_location.type_location_id', 'desc')
        ->orderBy('store_order.datetime_order', 'asc')
        ->orderBy('store_order.datetime_update', 'asc')
        ->get();
        return $location;
    }

    public function getLocationByOrder(Request $request)
    {
        $storeId = $request->storeId;
        $orderId = $request->orderId;
        $location = SDB::table('store_order')
        ->join('store_location', 'store_order.location_id', '=','store_location.id')
        ->select('store_location.id','store_location.name')
        ->where('store_order.store_id',$storeId)
        ->where('store_order.id',$orderId)
        ->whereIn('store_order.status',[1,2])
        ->get();
        return $location;
    }

    public function getFoodQueue(Request $request)
    {
        $storeId = $request->storeId;
        $queue = SDB::table('store_order')
        ->join('store_order_status', 'store_order_status.id', '=','store_order.status')
        ->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
        ->join('store_entities', 'store_entities.id', '=','store_order_detail.entities_id')
        ->selectRaw('store_entities.name as name, sum(quantity) as quantity')
        ->where('store_order.store_id',$storeId)
        ->whereIn('store_order.status',[1,2])
        ->groupBy('entities_id')
        ->orderBy('quantity', 'desc')
        ->get();
        return $queue;
    }
}