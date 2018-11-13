<?php
/**
 * Created by PhpStorm.
 * User: SonMT
 * Date: 11/9/2018
 * Time: 2:00 PM
 */

namespace App\Backend\Services\Production;
use App\Backend\Services\Interfaces\StoreManagerInterface;
use App\Core\Common\SDBStatusCode;
use App\Core\Dao\SDB;
use App\Core\Helpers\CommonHelper;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;



class StoreManagerService extends BaseService implements StoreManagerInterface
{
    public function getStoreManager()
    {
        $store = SDB::table("store_store")->get();
        foreach($store as $obj){
            if($obj->avatar==NULL){
             $obj->src = url('/')."/common_images/no-avatar.png";
            }else{
                $obj->src = CommonHelper::getImageUrl($obj->avatar);
            }
        }
        return $store;
    }
    public function addStoreManager($obj)
    {
        SDB::table("store_store")->insert($obj);
    }

    public function getById($id)
    {
        $obj = SDB::table("store_store")
            ->where("id",$id)->get();
        return $obj[0];
    }
    public function editStoreManager($obj)
    {
        SDB::table("store_store")
            ->where("id",$obj->id)
            ->update([
                "lat" => $obj->lat,
                "lng" => $obj->lng,
                "address" => $obj->address,
                "name" => $obj->name,
                "description" => $obj->description,
                "avartar" => $obj->avartar,
                "priority" => $obj->priority,
            ]);
    }
    public function deleteStoreManager($id)
    {
        SDB::table("store_store")->where("id",$id)->delete();
    }
    public function deleteAllStoreManager($arrId)
    {
        foreach($arrId as $obj){
            SDB::table("store_store")->where("id",$obj)->delete();
        }
    }
}