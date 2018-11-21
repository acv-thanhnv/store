<?php

namespace App\Api\V1\Services\Production;

use App\Api\V1\Services\Interfaces\CashierServiceInterface;
use App\Core\Common\OrderConst;
use App\Core\Common\OrderStatusValue;
use App\Core\Common\SDBStatusCode;
use App\Core\Dao\SDB;
use App\Core\Entities\DataResultCollection;
use App\Core\Events\OrderChefPusherEvent;
use App\Core\Events\OrderPusherEvent;
use App\Core\Helpers\CommonHelper;
use Illuminate\Http\Request;

class CashierService extends BaseService implements CashierServiceInterface
{
    public function getInvoicesByStore(Request $request)
    {
        $storeId = $request->storeId;
        $data = SDB::table('store_order')
        ->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
        ->join('store_entities', 'store_entities.id', '=','store_order_detail.entities_id')
        ->join('store_location', 'store_order.location_id', '=','store_location.id')
        ->join('store_floor', 'store_floor.id', '=','store_location.floor_id')
        ->join('store_type_location', 'store_location.type_location_id', '=','store_type_location.id')
        ->selectRaw('store_order.id as id, store_location.name as location, store_floor.name as floor, sum(store_entities.price*store_order_detail.quantity) as sum, store_type_location.subprice as locationFee, store_order.status')
        ->where('store_order.store_id',$storeId)
        ->whereIn('store_order.status',[OrderStatusValue::Process,OrderStatusValue::Done])
        ->groupBy('store_order.id')
        ->get();
        return $data;
    }

    public function getInvoicesByStore3(Request $request)
    {
        $storeId = $request->storeId;
        $data = SDB::table('store_order')
        ->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
        ->join('store_entities', 'store_entities.id', '=','store_order_detail.entities_id')
        ->join('store_location', 'store_order.location_id', '=','store_location.id')
        ->join('store_floor', 'store_floor.id', '=','store_location.floor_id')
        ->join('store_type_location', 'store_location.type_location_id', '=','store_type_location.id')
        ->selectRaw('store_order.id as id, store_location.name as location, store_floor.name as floor, sum(store_entities.price*store_order_detail.quantity) as sum, store_type_location.subprice as locationFee')
        ->where('store_order.store_id',$storeId)
        ->where('store_order.status',OrderStatusValue::Pay)
        ->groupBy('store_order.id')
        ->get();
        return $data;
    }

    public function getInvoiceDetailsChild($storeId, $orderId)
    {
        $details = SDB::table('store_order')
        ->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
        ->join('store_entities', 'store_entities.id', '=','store_order_detail.entities_id')
        ->join('store_location', 'store_location.id', '=','store_order.location_id')
        ->selectRaw('store_entities.id, store_entities.name,store_entities.price,store_order_detail.quantity,(store_entities.price*store_order_detail.quantity) as total')
        ->where('store_order.store_id',$storeId)
        ->where('store_order.id',$orderId)
        ->whereIn('store_order.status',[OrderStatusValue::Process,OrderStatusValue::Done])
        ->get();
        return $details;
    }

    public function getInvoiceDetailsChild3($storeId, $orderId)
    {
        $details = SDB::table('store_order')
        ->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
        ->join('store_entities', 'store_entities.id', '=','store_order_detail.entities_id')
        ->join('store_location', 'store_location.id', '=','store_order.location_id')
        ->selectRaw('store_entities.id, store_entities.name,store_entities.price,store_order_detail.quantity,(store_entities.price*store_order_detail.quantity) as total')
        ->where('store_order.store_id',$storeId)
        ->where('store_order.id',$orderId)
        ->where('store_order.status',OrderStatusValue::Pay)
        ->get();
        return $details;
    }

    public function getListOrdersByStore(Request $request) {
        $storeId = $request->storeId;
        $listOrder = SDB::table('store_order')
        ->select('store_order.id')
        ->where('store_order.store_id',$storeId)
        ->whereIn('store_order.status',[OrderStatusValue::Process,OrderStatusValue::Done])
        ->get();
        return $listOrder;
    }

    public function getListOrdersByStore3(Request $request) {
        $storeId = $request->storeId;
        $listOrder = SDB::table('store_order')
        ->select('store_order.id')
        ->where('store_order.store_id',$storeId)
        ->where('store_order.status', OrderStatusValue::Pay)
        ->get();
        return $listOrder;
    }

    public function getInvoiceDetails(Request $request) {
        $storeId = $request->storeId;
        $listOrder = $this->getListOrdersByStore($request);
        $data = [];
        foreach ($listOrder as $item) {
            array_push($data, $this->getInvoiceDetailsChild($storeId, $item->id));
        }
        return $data;
    }

    public function getInvoiceDetails3(Request $request) {
        $storeId = $request->storeId;
        $listOrder = $this->getListOrdersByStore3($request);
        $data = [];
        foreach ($listOrder as $item) {
            array_push($data, $this->getInvoiceDetailsChild3($storeId, $item->id));
        }
        return $data;
    }

    public function getRollbackCashierTable(Request $request)
    {
        $storeId = $request->storeId;
        $data = SDB::table('store_rollback_cashier')
        ->select('order_id', 'before_status')
        ->where('store_id', $storeId)
        ->get();
        return $data;
    }

    public function getAllPayment(Request $request) {
        $storeId = $request->storeId;
        $listOrderId = $request->listOrderId;
        $res = SDB::table('store_order')
        ->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
        ->join('store_entities', 'store_entities.id', '=','store_order_detail.entities_id')
        ->join('store_location', 'store_location.id', '=','store_order.location_id')
        ->selectRaw('store_entities.id, store_entities.name,store_entities.price,sum(store_order_detail.quantity) as quantity')
        ->where('store_order.store_id',$storeId)
        ->whereIn('store_order.id', $listOrderId)
        ->groupBy('store_entities.id')
        ->get();

        $res2 = SDB::table('store_order')
        ->join('store_location', 'store_location.id', '=','store_order.location_id')
        ->join('store_type_location', 'store_location.type_location_id', '=','store_type_location.id')
        ->selectRaw('sum(store_type_location.subprice) as locationFee')
        ->where('store_order.store_id',$storeId)
        ->whereIn('store_order.id', $listOrderId)
        ->get();

        $data = [
            'details' => $res,
            'locationFee' => $res2
        ];

        return $data;
    }
    
}