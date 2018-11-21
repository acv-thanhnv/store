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
             $obj->src = url('/')."/common_images/no-store.png";
            }else{
                $obj->src = CommonHelper::getImageUrl($obj->avatar);
            }
        }
        return $store;
    }
    public function addStoreManager($obj)
    {
        $idStore = SDB::table("store_store")->insertGetId($obj);
        return $idStore;
    }

    public function insertUser($obj)
    {
        try {
            SDB::beginTransaction();
            SDB::table("users")->insert([
                "name" => $obj->name,
                "email" => $obj->email,
                "role_value" => $obj->role,
                "password" => $obj->pass,
                "is_active"=>1
            ]);
            $id = SDB::table("users")->where([["name", $obj->name], ["email", $obj->email]])->select("id")->get();
            SDB::table("users_detail")->insert([
                "user_id" => $id[0]->id,
                "gender" => $obj->gender,
                "birth_date" => $obj->date,
                "avatar" => $obj->image
            ]);
            SDB::table('store_user_store')->insert([
                "store_id" => $storeId,
                "user_id" => $id[0]->id
            ]);
            SDB::commit();
        } catch (\Exception $e) {
            SDB::rollBack();
        }
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
            ->where("id",$obj->idStore)
            ->update([
                "lat"         => $obj->lat,
                "lng"         => $obj->lng,
                "address"     => $obj->address,
                "name"        => $obj->name,
                "description" => $obj->description,
                "avatar"      => $obj->avatar,
                "priority"    => $obj->priority,
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