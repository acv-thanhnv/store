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
            ->select('*')
            ->get();
        foreach ($obj as $obj_floor){
            $obj_floor->floor = SDB::table('store_floor')
                ->where('store_floor.id','=',$obj_floor->floor_id)
                ->where('store_floor.store_id','=',$storeId)
                ->get();
        }
        foreach ($obj as $obj_type){
            $obj_type->type= SDB::table('store_type_location')
                ->where('store_type_location.id','=', $obj_type->type_location_id)
                ->get();
        }
        return $obj;
    }
    public function addTable($obj)
    {
        SDB::table("store_table")->insert($obj);
    }
    public function editTable($obj)
    {
        SDB::table("store_store")
            ->where("id",$obj["id"])
            ->update([
                "name"        => $obj["name"],
                "lat"         => $obj["lat"],
                "lng"         => $obj["lng"],
                "address"     => $obj["address"],
                "avatar"      => $obj["avatar"],
                "description" => $obj["description"]
            ]);
    }

    public function getById($id)
    {
        $obj = SDB::table("store_menu")->where("id",$id)->get();
        return $obj[0];
    }
    public function editMenu($obj)
    {
        SDB::table("store_menu")->where("id",$obj->id)->update(["name" => $obj->name,"description"=> $obj->description]);
    }
    public function deleteMenu($id)
    {
        SDB::table("store_menu")->where("id",$id)->delete();
    }
    public function deleteAllMenu($arrId)
    {
        foreach($arrId as $obj){
            SDB::table("store_menu")->where("id",$obj)->delete();
        }
    }

}