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
        ->selectRaw('store_order.id as id, store_location.name as location, sum(store_entities.price*store_order_detail.quantity) as sum, store_location.price as locationFee')
        ->where('store_order.store_id',$storeId)
        ->where('store_order.status',2)
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
        ->selectRaw('store_order.id as id, store_location.name as location, sum(store_entities.price*store_order_detail.quantity) as sum, store_location.price as locationFee')
        ->where('store_order.store_id',$storeId)
        ->where('store_order.status',3)
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
        ->where('store_order.status',2)
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
        ->where('store_order.status',3)
        ->get();
        return $details;
    }

    public function getListOrdersByStore(Request $request) {
        $storeId = $request->storeId;
        $listOrder = SDB::table('store_order')
        ->select('store_order.id')
        ->where('store_order.store_id',$storeId)
        ->where('store_order.status',2)
        ->get();
        return $listOrder;
    }

    public function getListOrdersByStore3(Request $request) {
        $storeId = $request->storeId;
        $listOrder = SDB::table('store_order')
        ->select('store_order.id')
        ->where('store_order.store_id',$storeId)
        ->where('store_order.status',3)
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

}