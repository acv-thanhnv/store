<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 8/3/2018
 * Time: 10:44 AM
 */

namespace App\Backend\Services\Production;

use App\Backend\Services\Interfaces\FoodServiceInterface;
use App\Core\Common\SDBStatusCode;
use App\Core\Dao\SDB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
class FoodService extends BaseService implements FoodServiceInterface
{
    /**
     * @param $validateArray
     * @param $fileName
     * HELPER: Generation Config File contain text translated.
     */
    public function getFood($idStore)
    {
    	$arrFood = SDB::table("store_entities as en")
                    ->join("store_menu as menu","menu.id","=","en.menu_id")
    				->where("menu.store_id",$idStore)
                    ->select("en.*","menu.name as menuName")
                    ->orderby("en.id","desc")
    				->get();
    	return $arrFood;
    }
    public function addFood($obj)
    {
        $idFood = SDB::table("store_entities")->insertGetId($obj);
        return $idFood;
    }
    public function addProp($obj)
    {
        $idProp = SDB::table("store_entity_properties")->insertGetId($obj);
        return $idProp;
    }
    public function addPropValue($obj)
    {
        SDB::table("store_entity_property_values")->insert($obj);
    }
    public function getById($id)
    {
        $obj = SDB::table("store_entities as en")
                    ->join("store_menu as menu","menu.id","=","en.menu_id")
                    ->where("en.id",$id)
                    ->select("en.*","menu.name as menuName")
                    ->get();
        return $obj[0];
    }
    public function editFood($obj)
    {
        SDB::table("store_entity_Foods")->where("id",$obj->id)->update(["name" => $obj->name,"description"=> $obj->description]);
    }
    public function deleteFood($id)
    {
        SDB::table("store_entity_Foods")->where("id",$id)->delete();
    } 
    public function deleteAllFood($arrId)
    {
        foreach($arrId as $obj){
            SDB::table("store_entity_Foods")->where("id",$obj)->delete();
        }
    }
    public function getType($idStore)
    {
        $arrType = SDB::table("store_entity_types")->where("store_id",$idStore)->get();
        return $arrType;
    }
    public function getProp($idType)
    {
        $arrType = SDB::table("store_entity_properties")->where("entity_type_id",$idType)->get();
        return $arrType;
    }
    public function getPropByFood($idFood)
    {
        $arrProp = SDB::table("store_entity_property_values as value")
                    ->join("store_entity_properties as prop","value.property_id","=","prop.id")
                    ->where("value.entity_id",$idFood)->get();
        return $arrProp;
    }
    public function getMenu($idStore)
    {
        $arrType = SDB::table("store_menu")->where("store_id",$idStore)->get();
        return $arrType;
    }
    public function getDataType()
    {
        $arrData = SDB::table("store_prop_data_types")->get();
        return $arrData;
    }
}
