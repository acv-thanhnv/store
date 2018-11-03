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
use App\Core\Common\OrderStatusValue;
use App\Core\Common\SDBStatusCode;
use App\Core\Dao\SDB;
use App\Core\Entities\DataResultCollection;
use App\Core\Events\OrderChefPusherEvent;
use App\Core\Events\OrderPusherEvent;
use App\Core\Helpers\CommonHelper;
use Illuminate\Http\Request;

class FoodService extends BaseService implements FoodServiceInterface
{
    //====================get food===============
    public function getFoodByStoreId($storeId = null)
    {
        $list = SDB::table("view_entity_infor")
            ->where("store_id", $storeId)
            ->select('*')
            ->get();
        return $this->buildFoodListByStoreId($list, $storeId);
    }

    //===================get food by menu========================
    public function getFoodByMenuId($menuId = null, $storeId = null)
    {
        $list = SDB::table("view_entity_infor")
            ->whereRaw("? IS NOT NULL AND store_id = ?  AND (? IS NULL OR ? ='' OR ? = menu_id)", [$storeId, $storeId, $menuId, $menuId, $menuId])
            ->select('*')
            ->get();
        return $this->buildFoodListByMenu($list, $menuId, $storeId);
    }

    //===================get menu========================
    public function getMenuList($storeId = null)
    {
        $list = SDB::table("store_menu")
            ->whereRaw("store_id= ?", [$storeId])
            ->select('*')
            ->get();
        return $list;
    }

    //===================get floor========================
    public function getFloorsByStore($idStore)
    {
        $list = SDB::table('store_floor')
            ->where('store_id', $idStore)
            ->get();
        return $list;
    }

    //===================get location========================
    public function getLocation($idStore)
    {
        $list = SDB::table('store_location')
            ->select('*', 'store_location.name as location_name', 'store_location.id as location_id', 'store_floor.id as floor_id', 'store_floor.name as floor_name')
            ->join('store_floor', 'store_location.floor_id','=', 'store_floor.id')
            ->where('store_floor.store_id', $idStore)
            ->get();
        return $list;
    }
    //===================get location by floor========================
    public function getLocationbyFloor($idFloor, $idStore)
    {
        if ($idFloor != null) {
            $list = SDB::table('store_location')
                ->select('*')
                ->where('floor_id', $idFloor)
                ->where('store_id', $idStore)
                ->get();
        } else {
            $list = SDB::table('store_location')
                ->select('*')
                ->where('store_id', $idStore)
                ->get();
        }
        return $list;
    }


    //===================get Order by location========================
    public function getOrderByLocation($idLocation, $idStore)
    {
        $order = SDB::table('store_order')
            ->select('*','store_order.id', 'store_order.datetime_order', 'store_order.status', 'store_location.name as location_name')
            ->join('store_location', 'store_order.location_id', '=', 'store_location.id')
            ->where('store_order.store_id', $idStore)
            ->where('store_order.location_id', $idLocation)
            ->get();

        foreach($order as $order_detail){
            $order_detail-> detail = SDB::table('store_order_detail')
                ->join ('store_entities','store_order_detail.entities_id','=','store_entities.id')
                ->where('store_order_detail.order_id','=', $order_detail->id)
                ->get();
        };

        return $order;
    }

    //===================get Order detail========================
    public function getOrderDetail($idOrder)
    {
        $list = SDB::table('store_order_detail')
            ->join('store_entities', 'store_order_detail.entities_id', '=', 'store_entities.id')
            ->where('store_order_detail.order_id', $idOrder)
            ->get();
        return $list;
    }


    //==========================================
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
                $itemEntity->image = CommonHelper::getImageUrl($itemEntity->image);
                $itemEntity->price = number_format($itemEntity->price);
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

    protected function buildFoodListByMenu($foodList, $menuId, $storeId)
    {
        $listEntity = SDB::table("store_entities")
            ->join('store_menu', 'store_menu.id', '=', 'store_entities.menu_id')
            ->whereRaw("? IS NOT NULL AND store_menu.store_id = ?  AND (? IS NULL OR ?='' OR ? = store_entities.menu_id)", [$storeId, $storeId, $menuId, $menuId, $menuId])
            ->select('store_entities.*')
            ->get();
        $result = array();
        if (!empty($listEntity)) {
            foreach ($listEntity as $itemEntity) {
                $itemEntity->image = CommonHelper::getImageUrl($itemEntity->image);
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
}
