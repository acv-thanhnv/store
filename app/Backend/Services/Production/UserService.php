<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 8/3/2018
 * Time: 10:44 AM
 */

namespace App\Backend\Services\Production;

use App\Backend\Services\Interfaces\UserServiceInterface;
use App\Core\Common\RoleConst;
use App\Core\Dao\SDB;
use App\Core\Helpers\CommonHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserService extends BaseService implements UserServiceInterface
{
    /**
     * @param $validateArray
     * @param $fileName
     * HELPER: Generation Config File contain text translated.
     */
    public function getAll()
    {
        $currentRole = Auth::user()->role_value;
        $storeId = CommonHelper::getStoreId();
        $arrUser = SDB::table("users")
            ->join("sys_roles", "users.role_value", "=", "sys_roles.role_value")
            ->join('sys_role_config',"users.role_value","=","sys_role_config.role_value_allowed")
            ->leftJoin("users_detail as dt", "users.id", "=", "dt.user_id")
            ->join('store_user_store', 'store_user_store.user_id', '=', 'users.id')
            ->where('store_user_store.store_id', '=', $storeId)
            ->WhereRaw("sys_role_config.role_value = ?",[$currentRole])
            ->orderby("users.id", "desc")
            ->select("users.*", "sys_roles.name as role", "dt.avatar", "dt.gender")
            ->paginate(5);
        return $arrUser;
    }

    public function getRole()
    {
        $currentRole =  Auth::user()->role_value;
        $arrRole =SDB::table("sys_roles")
            ->join('sys_role_config',"sys_roles.role_value",'=',"sys_role_config.role_value_allowed")
            ->whereRaw("sys_role_config.role_value = ?",[$currentRole])
            ->select("sys_roles.*")
            ->get();
        return $arrRole;
    }

    public function getById($id)
    {
        $storeId = CommonHelper::getStoreId();
        $user = SDB::table("users")
            ->join("sys_roles", "users.role_value", "=", "sys_roles.role_value")
            ->leftJoin("users_detail", "users.id", "=", "users_detail.user_id")
            ->join('store_user_store', 'store_user_store.user_id', '=', 'users.id')
            ->where('store_user_store.store_id', '=', $storeId)
            ->where("users.id", $id)
            ->select("users.*", "users_detail.gender", "users_detail.birth_date", "users_detail.avatar", "sys_roles.name as RoleName")
            ->get();
        return $user[0];
    }

    public function update($obj)
    {
        //check pass and insert into table users
        if (isset($obj->pass)) {
            SDB::table("users")
                ->where("id", $obj->id)
                ->update([
                    "name"       => $obj->name,
                    "email"      => $obj->email,
                    "is_active"  => $obj->active,
                    "role_value" => $obj->role,
                    "password"   => $obj->pass
                ]);
        } else {
            SDB::table("users")
                ->where("id", $obj->id)
                ->update([
                    "name"       => $obj->name,
                    "email"      => $obj->email,
                    "is_active"  => $obj->active,
                    "role_value" => $obj->role
                ]);
        }
        //check image and insert into table users_details
        if ($obj->image != NULL) {
            SDB::table("users_detail")
                ->where("user_id", $obj->id)
                ->update([
                    "gender" => $obj->gender,
                    "birth_date" => $obj->date,
                    "avatar" => $obj->image
                ]);
        } else {
            SDB::table("users_detail")
                ->where("user_id", $obj->id)
                ->update([
                    "gender" => $obj->gender,
                    "birth_date" => $obj->date
                ]);
        }
    }

    public function insert($obj)
    {
        $storeId = CommonHelper::getStoreId();
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
                "user_id" => $id[0]->id,
            ]);
            SDB::commit();
        } catch (\Exception $e) {
            SDB::rollBack();
        }
    }

    public function delete($id)
    {
        $diskLocalName = "public";
        $oldImgSrc = SDB::table("users_detail")->where("user_id", $id)->select("avatar")->get();
        Storage::disk($diskLocalName)->delete($oldImgSrc[0]->avatar);
        try {
            SDB::beginTransaction();
            SDB::table("users")->where("id", $id)->delete();
            SDB::table("users_detail")->where("user_id", $id)->delete();
            SDB::table("store_user_store")->where("user_id", $id)->delete();
            SDB::commit();
        } catch (\Exception $e) {
            SDB::rollBack();
        }
    }

    public function deleteAll($arrUser)
    {
        $diskLocalName = "public";
        try {
            SDB::beginTransaction();
            foreach ($arrUser as $id) {
                $oldImgSrc = SDB::table("users_detail")->where("user_id", $id)->select("avatar")->get();
                Storage::disk($diskLocalName)->delete($oldImgSrc[0]->avatar);
                SDB::table("users")->where("id", $id)->delete();
                SDB::table("users_detail")->where("user_id", $id)->delete();
                SDB::table("store_user_store")->where("user_id", $id)->delete();
            }
            SDB::commit();
        } catch (\Exception $e) {
            SDB::rollBack();
        }
    }
}
