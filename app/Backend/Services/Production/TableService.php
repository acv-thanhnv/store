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
            ->select('*', 'store_location.name as location_name', 'store_floor.name as floor_name')
            ->join('store_floor','store_location.floor_id','=', 'store_floor.id' )
            ->where("store_id",$storeId)->get();
        return $obj;
    }
    public function addTable($obj)
    {
        SDB::table("store_Table")->insert($obj);
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

}