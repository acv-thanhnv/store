<?php
/**
 * Created by PhpStorm.
 * User: SonMT
 * Date: 11/2/2018
 * Time: 10:51 AM
 */

namespace App\Backend\Services\Production;

use App\Backend\Services\Interfaces\FloorServiceInterface;
use App\Core\Common\SDBStatusCode;
use App\Core\Dao\SDB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class FloorService extends BaseService implements FloorServiceInterface
{

    public function getMyFloor($storeId)
    {
        $obj = SDB::table("store_floor")->where("store_id",$storeId)->get();
        return $obj;
    }
    public function addFloor($obj)
    {
        SDB::table("store_floor")->insert($obj);
    }

    public function getById($id)
    {
        $obj = SDB::table("store_floor")
            ->where("id",$id)->get();
        return $obj[0];
    }
    public function editFloor($obj)
    {
        SDB::table("store_floor")
            ->where("id",$obj->id)
            ->update([
                "name" => $obj->name,
                ]);
    }
    public function deleteTable($id)
    {
        SDB::table("store_floor")->where("id",$id)->delete();
    }
    public function deleteAllTable($arrId)
    {
        foreach($arrId as $obj){
            SDB::table("store_floor")->where("id",$obj)->delete();
        }
    }

}