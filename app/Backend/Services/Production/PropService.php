<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 8/3/2018
 * Time: 10:44 AM
 */

namespace App\Backend\Services\Production;

use App\Backend\Services\Interfaces\PropServiceInterface;
use App\Core\Common\SDBStatusCode;
use App\Core\Dao\SDB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
class PropService extends BaseService implements PropServiceInterface
{
    /**
     * @param $validateArray
     * @param $fileName
     * HELPER: Generation Config File contain text translated.
     */
    public function getProp($idStore)
    {
    	$arrProp = SDB::table("store_entity_properties as prop")
                    ->join("store_prop_data_types as dataType","dataType.code_value","=","prop.data_type_code")
                    ->join("store_entity_types as type","type.id","=","prop.entity_type_id")
    				->where("type.store_id",$idStore)
                    ->select("prop.*","type.name as typeName","dataType.*")
                    ->orderby("prop.id","desc")
    				->get();
    	return $arrProp;
    }
    public function addProp($obj)
    {
        SDB::table("store_entity_Props")->insert($obj);
    }
    public function getById($id)
    {
        $obj = SDB::table("store_entity_Props")->where("id",$id)->get();
        return $obj[0];
    }
    public function editProp($obj)
    {
        SDB::table("store_entity_Props")->where("id",$obj->id)->update(["name" => $obj->name,"description"=> $obj->description]);
    }
    public function deleteProp($id)
    {
        SDB::table("store_entity_Props")->where("id",$id)->delete();
    } 
    public function deleteAllProp($arrId)
    {
        foreach($arrId as $obj){
            SDB::table("store_entity_Props")->where("id",$obj)->delete();
        }
    }
    public function getType($idStore)
    {
        $arrType = SDB::table("store_entity_types")->where("store_id",$idStore)->get();
        return $arrType;
    }
    public function getDataType()
    {
        $arrData = SDB::table("store_prop_data_types")->get();
        return $arrData;
    }
}
