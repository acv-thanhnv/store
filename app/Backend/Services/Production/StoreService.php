<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 8/3/2018
 * Time: 10:44 AM
 */

namespace App\Backend\Services\Production;

use App\Backend\Services\Interfaces\StoreServiceInterface;
use App\Core\Common\SDBStatusCode;
use App\Core\Dao\SDB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
class StoreService extends BaseService implements StoreServiceInterface
{
    /**
     * @param $validateArray
     * @param $fileName
     * HELPER: Generation Config File contain text translated.
     */
    public function addStore($obj)
    {
        SDB::table("store_store")->insert($obj);
    }
    public function getMyStore($storeId)
    {
        $obj = SDB::table("store_store")->where("id",$storeId)->get();
        return $obj[0];
    }
    public function editStore($obj)
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
