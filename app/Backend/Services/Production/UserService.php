<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 8/3/2018
 * Time: 10:44 AM
 */

namespace App\Backend\Services\Production;

use DB;
use App\Core\Common\SDBStatusCode;
use App\Backend\Services\Interfaces\UserServiceInterface;
use Illuminate\Support\Facades\Lang;
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
        $arrUser = DB::table("users")
                        ->join("sys_roles","users.role_value","=","sys_roles.role_value")
                        ->leftJoin("users_detail as dt","users.id","=","dt.user_id")
                        ->orderby("users.id","desc")
                        ->select("users.*","sys_roles.name as role","dt.avatar","dt.gender")
                        ->paginate(5);
        return $arrUser;
    }
    public function getRole()
    {
        $arrRole = DB::table("sys_roles")->get();
        return $arrRole;
    }
    public function getById($id)
    {
        $user = DB::table("users")
                    ->join("sys_roles","users.role_value","=","sys_roles.role_value")
                    ->leftJoin("users_detail","users.id","=","users_detail.user_id")
                    ->where("users.id",$id)
                    ->select("users.*","users_detail.gender","users_detail.birth_date","users_detail.avatar","sys_roles.name as RoleName")
                    ->get();
        return $user[0];
    }
    public function update($obj)
    {
        //check pass and insert into table users
        if(isset($obj->pass)){
            DB::table("users")
            ->where("id",$obj->id)
            ->update([
                "name"       => $obj->name,
                "email"      => $obj->email,
                "role_value" => $obj->role,
                "password"   => $obj->pass
            ]);
        }else{
            DB::table("users")
            ->where("id",$obj->id)
            ->update([
                "name"       => $obj->name,
                "email"      => $obj->email,
                "role_value" => $obj->role
            ]);
        }
        //check image and insert into table users_details
        if($obj->image!=NULL){
            DB::table("users_detail")
            ->where("user_id",$obj->id)
            ->update([
                "gender"     => $obj->gender,
                "birth_date" => $obj->date,
                "avatar"     => $obj->image
            ]);
        }else{
            DB::table("users_detail")
            ->where("user_id",$obj->id)
            ->update([
                "gender"     => $obj->gender,
                "birth_date" => $obj->date
            ]);
        }
    } 
    public function insert($obj)
    {
        DB::table("users")->insert([
            "name"       => $obj->name,
            "email"      => $obj->email,
            "role_value" => $obj->role,
            "password"   => $obj->pass,
        ]);
        $id = DB::table("users")->where([["name",$obj->name],["email",$obj->email]])->select("id")->get();
        DB::table("users_detail")->insert([
            "user_id"    => $id[0]->id,
            "gender"     => $obj->gender,
            "birth_date" => $obj->date,
            "avatar"     => $obj->image
        ]);
    }
    public function delete($id)
    {
        $diskLocalName = "public";
        $oldImgSrc = DB::table("users_detail")->where("user_id",$id)->select("avatar")->get();
        Storage::disk($diskLocalName)->delete($oldImgSrc[0]->avatar);
        DB::table("users")->where("id",$id)->delete();
        DB::table("users_detail")->where("user_id",$id)->delete();
    }
    public function deleteAll($arrUser)
    {
        $diskLocalName = "public";
        foreach($arrUser as $id) {
            $oldImgSrc = DB::table("users_detail")->where("user_id",$id)->select("avatar")->get();
            Storage::disk($diskLocalName)->delete($oldImgSrc[0]->avatar);
            DB::table("users")->where("id",$id)->delete();
            DB::table("users_detail")->where("user_id",$id)->delete();
        }
    }
}
