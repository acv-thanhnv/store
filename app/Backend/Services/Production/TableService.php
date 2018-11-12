<?php
/**
 * Created by PhpStorm.
 * User: SonMT
 * Date: 11/2/2018
 * Time: 10:51 AM
 */

namespace App\Backend\Services\Production;

use App\Backend\Services\Interfaces\TableServiceInterface;
use App\Core\Common\SDBStatusCode;
use App\Core\Dao\SDB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class TableService extends BaseService implements TableServiceInterface
{

    public function getMyTable($storeId)
    {
        $obj = SDB::table("store_location")
            ->join('store_floor','store_location.floor_id','=','store_floor.id')
            ->where('store_floor.store_id','=', $storeId)
            ->select('*','store_location.id as location_id','store_location.name as location_name', 'store_floor.name as floor_name')
            ->get();
        return $obj;
    }

    public function getFloor($storeId){
            $obj = SDB::table('store_floor')
                ->where('store_floor.store_id','=',$storeId)
                ->get();
            return $obj;
    }
    public function getTypeLocation(){

            $obj = SDB::table('store_type_location')
                ->get();
        return $obj;
    }

    public function addTable($obj)
    {
        SDB::table("store_location")
            ->insert($obj);
    }

    public function getById($id)
    {
        $obj = SDB::table("store_location")
            ->where("id",$id)->get();
        return $obj[0];
    }

    public function editTable($obj)
    {
        SDB::table("store_location")
            ->where("id",$obj->id)
            ->update([
                "name" => $obj->name,
                "type_location_id"=> $obj->type,
                "floor_id"=>$obj->floor,
                "price"=>$obj->price]);
    }
    public function deleteTable($id)
    {
        SDB::table("store_location")->where("id",$id)->delete();
    }
    public function deleteAllTable($arrId)
    {
        foreach($arrId as $obj){
            SDB::table("store_location")->where("id",$obj)->delete();
        }
    }

}