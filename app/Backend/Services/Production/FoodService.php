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
    protected $diskLocalName = "public";
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
        SDB::table("store_entities")
        ->where("id",$obj["id"])
        ->update([
            "name"    => $obj["name"],
            "image"   => $obj["image"],
            "price"   => $obj["price"],
            "menu_id" => $obj["menu_id"],
        ]);
    }
    public function editPropValue($obj)
    {
        SDB::table("store_entity_property_values")
        ->where("id",$obj["id"])
        ->update(["value" => $obj["value"]]);
    }
    public function deleteFood($id)
    {
        $image = SDB::table("store_entities")
                    ->where("id",$id)
                    ->select("image")
                    ->get();
        SDB::table("store_entities")->where("id",$id)->delete();
        $arrPropId = SDB::table("store_entity_property_values")
                ->where("entity_id",$id)
                ->select("property_id")
                ->get();
        $ids = Array();
        foreach($arrPropId as $obj){
            $ids[] = $obj->property_id;
        }
        $arr = SDB::table("store_entity_properties")
                ->whereIn('id',$ids)
                ->delete();
        SDB::table("store_entity_property_values")->where("entity_id",$id)->delete();
        Storage::disk($this->diskLocalName)->delete($image[0]->image);
    } 
    public function deleteFoodProp($id)
    {
        SDB::table("store_entity_properties")->where("id",$id)->delete();
        SDB::table("store_entity_property_values")->where("property_id",$id)->delete();
    } 
    public function deleteAllFood($arrId)
    {
        foreach($arrId as $id){
            $image = SDB::table("store_entities")
                        ->where("id",$id)
                        ->select("image")
                        ->get();
            SDB::table("store_entities")->where("id",$id)->delete();
            $arrPropId = SDB::table("store_entity_property_values")
            ->where("entity_id",$id)
            ->select("property_id")
            ->get();
            $ids = Array();
            foreach($arrPropId as $obj){
                $ids[] = $obj->property_id;
            }
            $arr = SDB::table("store_entity_properties")
            ->whereIn('id',$ids)
            ->delete();
            SDB::table("store_entity_property_values")->where("entity_id",$id)->delete();
            Storage::disk($this->diskLocalName)->delete($image[0]->image);
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
                    ->select("value.*","prop.property_label","prop.data_type_code","prop.sort")
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
