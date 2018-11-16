<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 8/3/2018
 * Time: 10:44 AM
 */

namespace App\Api\V1\Services\Production;

use App\Api\V1\Services\Interfaces\FoodServiceInterface;
use App\Core\Common\FoodConst;
use App\Core\Common\OrderConst;
use App\Core\Common\OrderStatusValue;
use App\Core\Common\SDBStatusCode;
use App\Core\Common\TableConst;
use App\Core\Dao\SDB;
use App\Core\Entities\DataResultCollection;
use App\Core\Events\OrderChefPusherEvent;
use App\Core\Events\OrderPusherEvent;
use App\Core\Helpers\CommonHelper;
use Illuminate\Http\Request;

class FoodService extends BaseService implements FoodServiceInterface
{
    //====================get location and floor===============
    public function getLocationFloor($storeId)
    {
        $list = SDB::table('store_floor')
            ->where('store_floor.store_id','=',$storeId)
            ->paginate(TableConst::TablePerPage);
        foreach ($list as $floor){
            $floor->location = SDB::table('store_location')
                ->where('store_location.floor_id','=',$floor->id)
                ->get();
        }
        return $list;
    }

    //===================get food by menu========================
    public function getFoodByMenuId($menuId = null, $storeId = null)
    {
        if($menuId=='*'){
            $list = SDB::table("store_entities as en")
                    ->join('store_menu as menu','menu.id','=','en.menu_id')
                    ->where('menu.store_id',$storeId)
                    ->select('en.*')
                    ->paginate(FoodConst::foodPerPage);
        }else{
            $list = SDB::table("store_entities as en")
                    ->join('store_menu as menu','menu.id','=','en.menu_id')
                    ->where('menu.store_id',$storeId)
                    ->where('menu.id',$menuId)
                    ->select('en.*')
                    ->paginate(FoodConst::foodPerPage);
        }
        foreach($list as $obj){
            $obj->src = CommonHelper::getImageSrc($obj->image);
            $obj->price = number_format($obj->price);
        }
        return $list;
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
    public function getLocation($idStore,$idFloor)
    {
        if ($idFloor != null) {
            $list = SDB::table('store_location')
                ->select('store_location.*', 'store_location.name as location_name', 'store_location.id as location_id', 'store_floor.id as floor_id', 'store_floor.name as floor_name')
                ->join('store_floor', 'store_location.floor_id','=', 'store_floor.id')
                ->where('store_floor.store_id', $idStore)
                ->where('store_location.floor_id', $idFloor)
                ->get();
        }else {
            $list = SDB::table('store_location')
                ->join('store_floor','store_location.floor_id','=','store_floor.id')
                ->select('store_location.*','store_floor.name as floor_name')
                ->where('store_floor.store_id', $idStore)
                ->get();
        }
        return $list;
    }

    //===================get Order by location========================
    public function getOrderByLocation($idLocation, $idStore)
    {
        $order = SDB::table('store_order')
            ->select('*','store_order.id', 'store_order.datetime_order', 'status.name as status_name', 'store_location.name as location_name')
            ->join('store_location', 'store_order.location_id', '=', 'store_location.id')
            ->join('store_order_status as status','status.value','=','store_order.status')
            ->where('store_order.store_id', $idStore)
            ->where('store_order.location_id', $idLocation)
            ->where('store_order.status','<',OrderStatusValue::Pay)
            ->orderby('store_order.id','asc')
            ->get();
        foreach($order as $order_detail){
            $order_detail ->detail = SDB::table('store_order_detail as o_detail')
                ->join ('store_entities','o_detail.entities_id','=','store_entities.id')
                ->join('store_order_detail_status as s_detail','s_detail.value','=','o_detail.status')
                ->select('o_detail.*','store_entities.name','store_entities.image','store_entities.price','s_detail.status_name','o_detail.cooked')
                ->where('o_detail.order_id','=', $order_detail->id)
                ->get();
            foreach($order_detail ->detail as $foodItem){
                //check avatar
                $foodItem->src = CommonHelper::getImageSrc($foodItem->image);
            }
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
                $itemEntity->src = CommonHelper::getImageUrl($itemEntity->image);
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
