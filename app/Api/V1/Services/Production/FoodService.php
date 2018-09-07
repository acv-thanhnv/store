<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 8/3/2018
 * Time: 10:44 AM
 */

namespace App\Api\V1\Services\Production;
use App\Api\V1\Services\Interfaces\FoodServiceInterface;
use App\Core\Dao\SDB;
class FoodService extends BaseService implements FoodServiceInterface
{
    public function getFoodByStoreId($storeId = null)
    {
        $list = SDB::table("view_entity_infor")
                    ->where("store_id",$storeId)
            ->select('*')
            ->get();
        return $this->buildFoodListObject($list,$storeId);
    }
    protected function buildFoodListObject($foodList,$storeId){
        $listEntity = SDB::table("store_entities")
            ->leftJoin("store_menu","store_menu.id","=","store_entities.menu_id")
            ->where("store_menu.store_id",$storeId)
            ->select('store_entities.*')
            ->get();
        $result = array();
        if(!empty($listEntity)){
            foreach ($listEntity as $itemEntity) {
                $foods = $itemEntity;
                $foods->props= array();
                $prop = array();
                foreach ($foodList as $foodItem){
                    if($foodItem->id==$foods->id){
                        $foods->entity_type_id=$foodItem->entity_type_id;
                        $foods->entity_type_name=$foodItem->entity_type_name;
                        $foods->entity_type_description=$foodItem->entity_type_description;

                        $prop['entity_prop_id']=$foodItem->entity_prop_id;
                        $prop['data_type_code']=$foodItem->data_type_code;
                        $prop['prop_data_type']=$foodItem->prop_data_type;
                        $prop['property_label']=$foodItem->property_label;
                        $prop['property_name']=$foodItem->property_name;
                        $prop['value']=$foodItem->value;

                        $foods->props[]= $prop;
                    }
                }
                $result[] = $foods;
            }
        }
        return $result;

    }
}
