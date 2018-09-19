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
    public function getFoodByStoreId($storeId = null)
    {
        $list = SDB::table("view_entity_infor")
            ->where("store_id", $storeId)
            ->select('*')
            ->get();
        return $this->buildFoodListByStoreId($list, $storeId);
    }

    public function getFoodByMenuId($menuId = null,$storeId = null)
    {
        $list = SDB::table("view_entity_infor")
            ->whereRaw("? IS NOT NULL AND store_id = ?  AND (? IS NULL OR ? ='' OR ? = menu_id)",[$storeId,$storeId,$menuId,$menuId,$menuId])
            ->select('*')
            ->get();
        return $this->buildFoodListByMenu($list, $menuId,$storeId);
    }

    public function getMenuList($storeId = null)
    {
        $list = SDB::table("store_menu")
            ->whereRaw("store_id= ?", [$storeId])
            ->select('*')
            ->get();
        return $list;
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
            ->join('store_menu','store_menu.id','=','store_entities.menu_id')
            ->whereRaw("? IS NOT NULL AND store_menu.store_id = ?  AND (? IS NULL OR ?='' OR ? = store_entities.menu_id)",[$storeId,$storeId,$menuId,$menuId,$menuId])
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
