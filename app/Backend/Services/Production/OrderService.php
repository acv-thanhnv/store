<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 8/3/2018
 * Time: 10:44 AM
 */

namespace App\Backend\Services\Production;

use App\Backend\Services\Interfaces\OrderServiceInterface;
use App\Core\Common\OrderConst;
use App\Core\Common\OrderStatusValue;
use App\Core\Common\SDBStatusCode;
use App\Core\Dao\SDB;
use App\Core\Entities\DataResultCollection;
use App\Core\Events\OrderChefPusherEvent;
use App\Core\Events\OrderPusherEvent;
use App\Core\Helpers\CommonHelper;
use Illuminate\Http\Request;
class OrderService extends BaseService implements OrderServiceInterface
{
    public function orderToWaiter(Request $request)
    {
        $result = new DataResultCollection();
        //event to
        $response = $request->all();
        $storeId = isset($response['storeId']) ? $response['storeId'] : 0;
        $locationId = isset($response['locationId']) ? $response['locationId'] : 0;
        $locationName = isset($response['locationName']) ? $response['locationName'] : '';
        $totalPrice = isset($response['totalPrice']) ? $response['totalPrice'] : 0;
        $description = isset($response['description']) ? $response['description'] : '';
        $entity = json_decode($response['entity']);
        if (CommonHelper::existsStore($storeId)) {
            //insert into Database
            $dataOrder = array(
                "store_id" => $storeId,
                "location_id" => $locationId,
                "datetime_order" => now(),
                "status" => OrderStatusValue::Waiter,
                "priority" => 1,
                "description"=>$description
            );
            $now = now()->toDateTimeString();
            try {
                SDB::beginTransaction();
                $newOrderId = SDB::table('store_order')->insertGetId($dataOrder);
                $data = array();
                if (!empty($entity)) {
                    foreach ($entity as $key => $order) {
                        $data[] = array(
                            'order_id' => $newOrderId,
                            'entities_id' => isset($order->id) ? $order->id : 0,
                            'quantity' => isset($order->quantity) ? $order->quantity : 0
                        );
                    }
                }
                if (!empty($data)) {
                    SDB::table('store_order_detail')->insert($data);
                }
                $requestType = OrderConst::TypeAdd;
                event(new OrderPusherEvent($storeId, $newOrderId, $locationId,$locationName, $totalPrice,$description,$requestType,$now, $entity));
                SDB::commit();
                $result->status = SDBStatusCode::OK;
            } catch (\Exception $e) {
                SDB::rollBack();
                $result->status = SDBStatusCode::Excep;
                $result->message = $e->getMessage();
            }
        }else{
            $result->status = SDBStatusCode::Excep;
            $result->message = "Store not exists";
        }

        return $result;
    }

    public function orderToChef(Request $request)
    {
        $result = new DataResultCollection();
        //event to
        $response = $request->all();
        $storeId = isset($response['storeId']) ? $response['storeId'] : 0;
        $orderId = isset($response['orderId']) ? $response['orderId'] : 0;
        $locationId = isset($response['locationId']) ? $response['locationId'] : 0;
        $locationName = isset($response['locationName']) ? $response['locationName'] : '';
        $totalPrice = isset($response['totalPrice']) ? $response['totalPrice'] : 0;
        $description = isset($response['description']) ? $response['description'] : '';
        $entity = json_decode($response['entity']);
        //Update Database
        $dataOrder = array(
            "status" => OrderStatusValue::Cheft,
        );
        $now = now()->toDateTimeString();
        if (CommonHelper::existsStore($storeId)) {
            SDB::table('store_order')->where('id', $orderId)->update($dataOrder);
            //send to chef
            $requestTypeChef = OrderConst::TypeAdd;
            event(new OrderChefPusherEvent($storeId, $orderId, $locationId,$locationName, $totalPrice,$description,$requestTypeChef,$now, $entity));
            //remove from waiter
            $requestType = OrderConst::TypeClearTrash;
            event(new OrderPusherEvent($storeId, $orderId, $locationId,$locationName, $totalPrice,$description,$requestType,$now, $entity));
            $result->status = SDBStatusCode::OK;
        } else {
            $result->status = SDBStatusCode::Excep;
            $result->message = "Store not exists";
        }
        return $result;
    }

    public function closeOrder(Request $request)
    {
        //event to
        $response = $request->all();
        $storeId = isset($response['storeId']) ? $response['storeId'] : 0;
        $orderId = isset($response['orderId']) ? $response['orderId'] : 0;
        $locationId = isset($response['locationId']) ? $response['locationId'] : 0;
        $locationName = isset($response['locationName']) ? $response['locationName'] : '';
        $totalPrice = isset($response['totalPrice']) ? $response['totalPrice'] : 0;
        $description = isset($response['description']) ? $response['description'] : '';
        $entity = json_decode($response['entity']);
        $now = now()->toDateTimeString();
        //Update Database
        $dataOrder = array(
            "status" => OrderStatusValue::Close,
        );
        SDB::table('store_order')->where('id', $orderId)->update($dataOrder);
        //clear to chef
        $requestTypeChef = OrderConst::TypeClearTrash;
        event(new OrderChefPusherEvent($storeId, $orderId, $locationId,$locationName, $totalPrice,$description,$requestTypeChef,$now, $entity));
        $result = new DataResultCollection();
        return $result;
    }
    public function deleteOrder(Request $request,$userStoreId,$orderStatus){
        $response = $request->all();
        $orderId = isset($response['orderId']) ? $response['orderId'] : 0;
        $storeId =  SDB::table('store_order')->whereRaw('id = ?',[$orderId])->select('*')->get()->first()->store_id;
        $result = new DataResultCollection();
        if($userStoreId == $storeId){
            $locationId = isset($response['locationId']) ? $response['locationId'] : 0;
            $locationName = isset($response['locationName']) ? $response['locationName'] : '';
            $description = isset($response['description']) ? $response['description'] : '';
            $totalPrice = isset($response['totalPrice']) ? $response['totalPrice'] : 0;
            $entity = isset($response['entity']) ? json_decode($response['entity']):'';
            SDB::table('store_order')
                ->where('store_order.id','=',$orderId)
                ->where('store_order.store_id','=',$storeId)
                ->update(array('status'=>OrderStatusValue::Deleted));
            $requestClearType = OrderConst::TypeClearTrash;
            $now = now()->toDateTimeString();
            if($orderStatus == OrderStatusValue::Waiter){
                event(new OrderPusherEvent($storeId, $orderId, $locationId,$locationName, $totalPrice,$description,$requestClearType,$now, $entity));
            }else if($orderStatus == OrderStatusValue::Cheft){
                event(new OrderPusherEvent($storeId, $orderId, $locationId,$locationName, $totalPrice,$description,$requestClearType,$now, $entity));
            }
            $result->status = SDBStatusCode::OK;
        }else{
            $result->status = SDBStatusCode::WebError;
            $result->message = "Store incorrect";
        }
        return $result;
    }


    public function getOrderList( $storeId, $orderStatus=null,$orderDate=null,$page=null,$limitPage=null){
        $result  =  new DataResultCollection();
        try{
            $orderList =  $this->buildOrderList($storeId,$orderStatus,$orderDate,$page,$limitPage);
            $result->status = SDBStatusCode::OK;
            $result->data = $orderList['data'];
            $result->totalRecord = $orderList['totalRecord'];
        }catch (\Exception $e){
            $result->status = SDBStatusCode::Excep;
            $result->message = $e->getMessage();
        }
        return $result;
    }

    protected function buildFoodListByStoreId($foodList, $storeId)
    {
        $listEntity = SDB::table("store_entities")
            ->leftJoin("store_menu", "store_menu.id", "=", "store_entities.menu_id")
            ->where("store_menu.store_id", $storeId)
            ->select('store_entities.*')
            ->get();
        $result = array();
        if (!empty($listEntity)) {
            foreach ($listEntity as $itemEntity) {
                $foods = $itemEntity;
                $foods->props = array();
                $prop = array();
                foreach ($foodList as $foodItem) {
                    if ($foodItem->id == $foods->id) {
                        $prop['entity_prop_id'] = $foodItem->entity_prop_id;
                        $prop['data_type_code'] = $foodItem->data_type_code;
                        $prop['prop_data_type'] = $foodItem->prop_data_type;
                        $prop['property_label'] = $foodItem->property_label;
                        $prop['property_name'] = $foodItem->property_name;
                        $prop['value'] = $foodItem->value;

                        $foods->props[] = $prop;
                    }
                }
                $result[] = $foods;
            }
        }
        return $result;

    }

    protected function buildFoodListByMenu($foodList, $menuId)
    {
        $listEntity = SDB::table("store_entities")
            ->whereRaw("? IS NULL", [$menuId])
            ->orWhereRaw("?=''", [$menuId])
            ->orWhereRaw("menu_id = ?", [$menuId])
            ->select('store_entities.*')
            ->get();
        $result = array();
        if (!empty($listEntity)) {
            foreach ($listEntity as $itemEntity) {
                $foods = $itemEntity;
                $foods->props = array();
                $prop = array();
                foreach ($foodList as $foodItem) {
                    if ($foodItem->id == $foods->id) {
                        $prop['entity_prop_id'] = $foodItem->entity_prop_id;
                        $prop['data_type_code'] = $foodItem->data_type_code;
                        $prop['prop_data_type'] = $foodItem->prop_data_type;
                        $prop['property_label'] = $foodItem->property_label;
                        $prop['property_name'] = $foodItem->property_name;
                        $prop['value'] = $foodItem->value;

                        $foods->props[] = $prop;
                    }
                }
                $result[] = $foods;
            }
        }
        return $result;
    }
    protected function buildOrderList($storeId,$orderStatus=null,$dateOrder = null,$page=null,$pageLimit=null){
        $orderObjList = SDB::table('store_order')
            ->leftJoin('store_order_detail','store_order.id','=','store_order_detail.order_id')
            ->leftJoin('store_entities','store_entities.id','=','store_order_detail.entities_id')
            ->leftJoin('store_location','store_order.location_id','=','store_location.id')
            ->selectRaw('store_order.id,store_order.store_id,store_order.location_id,store_order.description,store_order.datetime_order,store_location.name AS location_name,store_order.status,SUM(store_order_detail.quantity * store_entities.price ) AS totalPrice')
            ->where("store_order.store_id",$storeId)
            ->whereRaw("(? IS NULL OR ?=store_order.status)",[$orderStatus,$orderStatus])
            ->whereRaw("(? IS NULL OR  DATE(store_order.datetime_order) = ?)",[$dateOrder,$dateOrder])
            ->groupBy("store_order.id","store_order.store_id","store_order.location_id","store_order.description","store_order.datetime_order","store_order.status","store_location.name")
            ->orderByDesc('store_order.datetime_order');
        if($page !=null && $pageLimit!=null){
            $orderList = $orderObjList->paginate($pageLimit,['*'],'page',$page);
        }else{
            $orderList = $orderObjList->get();
        }
        $countOrder = SDB::table('store_order')
            ->where("store_order.store_id",$storeId)
            ->whereRaw("(? IS NULL OR ?=store_order.status)",[$orderStatus,$orderStatus])
            ->whereRaw("(? IS NULL OR  DATE(store_order.datetime_order) = ?)",[$dateOrder,$dateOrder])
            ->count();
        $orderListDetail = SDB::table('store_order')
            ->join("store_order_detail","store_order.id","=","store_order_detail.order_id")
            ->where("store_order.store_id",$storeId)
            ->whereRaw("(? IS NULL OR ?=store_order.status)",[$orderStatus,$orderStatus])
            ->whereRaw("(? IS NULL OR DATE(store_order.datetime_order)=?)",[$dateOrder,$dateOrder])
            ->select()
            ->get();
        $orderEntityInfoList = SDB::table('store_order')
            ->join("store_order_detail","store_order.id","=","store_order_detail.order_id")
            ->join("view_entity_infor","store_order_detail.entities_id","=","view_entity_infor.id")
            ->where("store_order.store_id",$storeId)
            ->whereRaw("(? IS NULL OR ?=store_order.status)",[$orderStatus,$orderStatus])
            ->whereRaw("(? IS NULL OR  DATE(store_order.datetime_order) = ?)",[$dateOrder,$dateOrder])
            ->select("view_entity_infor.*")
            ->distinct()
            ->get();
        $orderEntityList = SDB::table('store_order')
            ->join("store_order_detail","store_order.id","=","store_order_detail.order_id")
            ->join("store_entities","store_order_detail.entities_id","=","store_entities.id")
            ->where("store_order.store_id",$storeId)
            ->whereRaw("(? IS NULL OR ?=store_order.status)",[$orderStatus,$orderStatus])
            ->whereRaw("(? IS NULL OR  DATE(store_order.datetime_order) = ?)",[$dateOrder,$dateOrder])
            ->select("store_entities.id","store_entities.name","store_entities.menu_id","store_entities.image","store_entities.price")
            ->distinct()
            ->get();
        $resultEntity = array();
        if (!empty($orderEntityList)) {
            foreach ($orderEntityList as $itemEntity) {
                $foods = $itemEntity;
                $foods->price = number_format($foods->price);
                $foods->props = array();
                $prop = array();
                foreach ($orderEntityInfoList as $foodItem) {
                    if ($foodItem->id == $foods->id) {
                        $prop['entity_prop_id'] = $foodItem->entity_prop_id;
                        $prop['data_type_code'] = $foodItem->data_type_code;
                        $prop['prop_data_type'] = $foodItem->prop_data_type;
                        $prop['property_label'] = $foodItem->property_label;
                        $prop['property_name'] = $foodItem->property_name;
                        $prop['value'] = $foodItem->value;
                        $foods->props[] = $prop;
                    }
                }
                $resultEntity[$itemEntity->id] = $foods;
            }
        }
        $orderInfor = array();
        if (!empty($orderList)) {
            foreach ($orderList as $itemOrder) {
                $order =  (object) array(
                    "storeId"=>$itemOrder->store_id,
                    "orderId"=> $itemOrder->id,
                    "locationId"=> $itemOrder->location_id,
                    "locationName"=> $itemOrder->location_name,
                    "totalPrice"=> number_format($itemOrder->totalPrice),
                    "description"=>$itemOrder->description,
                    "status"=>$itemOrder->status,
                    "dateTimeOrder"=>$itemOrder->datetime_order
                );
                $order->entity = array();
                foreach ($orderListDetail as $orderDetail) {
                    if ($itemOrder->id == $orderDetail->order_id) {
                        $food = $resultEntity[$orderDetail->entities_id];
                        $food->quantity = $orderDetail->quantity;
                        $food->avatar = CommonHelper::getImageUrl($food->image);
                        $order->entity[]= $food;
                    }
                }
                $orderInfor[] = $order;
            }
        }
        $dataFinal = array(
            'totalRecord'=>$countOrder,
            'data'=>$orderInfor
        );
        return $dataFinal;
    }
}
