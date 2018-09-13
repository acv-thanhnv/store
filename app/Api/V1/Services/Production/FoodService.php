<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 8/3/2018
 * Time: 10:44 AM
 */

namespace App\Api\V1\Services\Production;

use App\Api\V1\Services\Interfaces\FoodServiceInterface;
use App\Core\Common\OrderConst;
use App\Core\Common\SDBStatusCode;
use App\Core\Dao\SDB;
use App\Core\Entities\DataResultCollection;
use App\Core\Events\OrderChefPusherEvent;
use App\Core\Events\OrderPusherEvent;
use App\Core\Helpers\CommonHelper;
use Illuminate\Http\Request;

class FoodService extends BaseService implements FoodServiceInterface
{
    public function getFoodByStoreId($storeId = null)
    {
        $list = SDB::table("view_entity_infor")
            ->where("store_id", $storeId)
            ->select('*')
            ->get();
        return $this->buildFoodListByStoreId($list, $storeId);
    }

    public function getFoodByMenuId($menuId = null)
    {
        $list = SDB::table("view_entity_infor")
            ->whereRaw("? IS NULL", [$menuId])
            ->orWhereRaw("?=''", [$menuId])
            ->orWhereRaw("menu_id = ?", [$menuId])
            ->select('*')
            ->get();
        return $this->buildFoodListByMenu($list, $menuId);
    }

    public function getMenuList($storeId = null)
    {
        $list = SDB::table("store_menu")
            ->whereRaw("store_id= ?", [$storeId])
            ->select('*')
            ->get();
        return $list;
    }

    public function orderToWaiter(Request $request)
    {
        $result = new DataResultCollection();
        //event to
        $response = $request->all();
        $storeId = isset($response['storeId']) ? $response['storeId'] : 0;
        $locationId = isset($response['locationId']) ? $response['locationId'] : 0;
        $totalPrice = isset($response['totalPrice']) ? $response['totalPrice'] : 0;
        $entity = json_decode($response['entity']);
        if (CommonHelper::existsStore($storeId)) {
            //insert into Database
            $dataOrder = array(
                "store_id" => $storeId,
                "location_id" => $locationId,
                "datetime_order" => now(),
                "status" => 2,
                "priority" => 1
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
                event(new OrderPusherEvent($storeId, $newOrderId, $locationId, $totalPrice,$now, $entity));
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
        $totalPrice = isset($response['totalPrice']) ? $response['totalPrice'] : 0;
        $entity = json_decode($response['entity']);
        //Update Database
        $dataOrder = array(
            "status" => 3,
        );
        $now = now()->toDateTimeString();
        if (CommonHelper::existsStore($storeId)) {
            SDB::table('store_order')->where('id', $orderId)->update($dataOrder);
            event(new OrderChefPusherEvent($storeId, $orderId, $locationId, $totalPrice,$now, $entity));
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
        $orderId = isset($response['orderId']) ? $response['orderId'] : 0;
        //Update Database
        $dataOrder = array(
            "status" => 4,
        );
        SDB::table('store_order')->where('id', $orderId)->update($dataOrder);
        $result = new DataResultCollection();
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
                        $foods->entity_type_id = $foodItem->entity_type_id;
                        $foods->entity_type_name = $foodItem->entity_type_name;
                        $foods->entity_type_description = $foodItem->entity_type_description;

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
                        $foods->entity_type_id = $foodItem->entity_type_id;
                        $foods->entity_type_name = $foodItem->entity_type_name;
                        $foods->entity_type_description = $foodItem->entity_type_description;

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
}
