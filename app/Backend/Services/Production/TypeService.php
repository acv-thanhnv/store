<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 8/3/2018
 * Time: 10:44 AM
 */

namespace App\Backend\Services\Production;

use App\Backend\Services\Interfaces\TypeServiceInterface;
use App\Core\Common\SDBStatusCode;
use App\Core\Dao\SDB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
class TypeService extends BaseService implements TypeServiceInterface
{
    /**
     * @param $validateArray
     * @param $fileName
     * HELPER: Generation Config File contain text translated.
     */
    public function getType($idStore)
    {
    	$arrType = SDB::table("store_entity_types as type")
                    ->where("type.store_id",$idStore)
                    ->orderby("type.id","desc")
                    ->get();
    	return $arrType;
    }
    public function getProp($idType)
    {
        $arrProp = SDB::table("store_entity_properties as prop")
                    ->join("store_prop_data_types as data","prop.data_type_code","=","data.code_value")
                    ->select("prop.*","data.name","data.code_value")
                    ->where("prop.entity_type_id",$idType)
                    ->orderby("prop.sort","desc")
                    ->orderby("prop.id","desc")
                    ->get();
        return $arrProp;
    }
    public function getDataType()
    {
        $arrData = SDB::table("store_prop_data_types")->get();
        return $arrData;
    }
    public function addType($obj)
    {
        $id = SDB::table("store_entity_types")->insertGetId($obj);
        return $id;
    }
    public function addProp($obj)
    {
        SDB::table("store_entity_properties")->insert($obj);
    }
    public function getById($id)
    {
        $obj = SDB::table("store_entity_types")->where("id",$id)->get();
        return $obj[0];
    }
    public function editType($obj)
    {
        $type = SDB::table("store_entity_types")->where("id",$obj["id"])
                    ->update(["name" => $obj["name"],"description"=> $obj["description"]]);
    }
    public function editProp($obj)
    {
        SDB::table("store_entity_properties")->where("id",$obj["id"])
                    ->update([
                        "property_name"  => $obj["property_name"],
                        "property_label" => $obj["property_label"],
                        "data_type_code" => $obj["data_type_code"],
                        "sort"           => $obj["sort"]
                    ]);
    }
    public function deleteType($id)
    {
        SDB::table("store_entity_types")->where("id",$id)->delete();
        SDB::table("store_entity_properties")->where("entity_type_id",$id)->delete();
    } 
    public function deleteAllType($arrId)
    {
        foreach($arrId as $obj){
            SDB::table("store_entity_types")->where("id",$obj)->delete();
            SDB::table("store_entity_properties")->where("entity_type_id",$id)->delete();
        }
    }
    public function deleteProp($id)
    {
        SDB::table("store_entity_properties")->where("id",$id)->delete();
    }
}
