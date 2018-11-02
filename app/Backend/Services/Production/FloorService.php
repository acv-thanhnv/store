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
    public function editFloor($obj)
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