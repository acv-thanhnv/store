<?php
/**
 * Created by PhpStorm.
 * User: SonMT
 * Date: 11/2/2018
 * Time: 10:53 AM
 */

namespace App\Core\Http\Controllers;
use App\Core\Common\SDBStatusCode;
use App\Core\Common\UserValue;
use App\Core\Dao\SDB;
use App\Core\Entities\DataResultCollection;
use App\Core\Helpers\CommonHelper;
use App\Core\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AdminController
{
    public function getList(){
        $arrUser = SDB::table('users')
                    ->join('users_detail','users_detail.user_id','=','users.id')
                    ->where('role_value',UserValue::role_manager)
                    ->get();
        foreach ($arrUser as $obj) {
            if($obj->avatar==NULL){
             $obj->src = url('/')."/common_images/no-avatar.png";
         }else{
            $obj->src = CommonHelper::getImageUrl($obj->avatar);
        }
        }
        return view("backend.users.admin.list",['arrUser' => $arrUser]);
    }
    public function profile(Request $request){
        $diskLocalName = StorageDisk::diskLocalName;
        $user = $this->service->getById($request->id);
        if($user->avatar==NULL){
           $user->src = url('/')."/common_images/no-avatar.png";
       }else{
        $user->src = CommonHelper::getImageUrl($user->avatar);
        }
        return view("backend.users.profile",["user" => $user]);
    }
    public function add()
    {
        $arrRole = $this->service->getRole();
        return view("backend.users.add",["arrRole" => $arrRole]);
    }
public function addPost(Request $request)
{
    $image  = $request->file("image");
    $result =  new DataResultCollection();
    $rule_image = "";
    if($image!=NULL){
        $rule_image = "mimes:".UploadConst::FILE_IMAGE_UPLOAD_ACCESSED."|image|max:".UploadConst::BACKEND_UPLOAD_IMAGE_MAX;
    }
    $rule   = [
        "image" => $rule_image,
        "name"  => "required|min:3|max:32",
        "date"  => "required|date",
        "email" => "required|email|unique:users",
        "pass"  => "required|min:3|max:32",
        "role"  => "required"
    ];
    $message_rule = [
        '*.mimes' => 'Mime not Allowed'
    ];
    $validator = Validator::make($request->all(),$rule,$message_rule);
    if (!$validator->fails()) {
        if($image!=NULL){
            $result = $this->uploadService->uploadFile(array($image),$diskLocalName,'uploads/avatars','');
            foreach ($result->data as $data){
                $imageUrl = $data["uri"];
            }
        } else{
            $result->status = SDBStatusCode::OK;
        }

    } else {
        $error           = array($validator->errors());
        $result->status  = SDBStatusCode::ValidateError;
        $result->message = 'An error occured while uploading avatar or validate!';
        $result->data    =$error;
    }
    if($result->status==SDBStatusCode::OK){
        $obj        = new \stdClass();
        $obj->image = NULL;
        if($image!=NULL){
            $obj->image  = $imageUrl;
        }
        $obj->name   = $request->name;
        $obj->date   = $request->date;
        $obj->gender = $request->gender;
        $obj->email  = $request->email;
        $obj->pass   = Hash::make($request->pass);
        $obj->role   = $request->role;
        $this->service->insert($obj);
    }
    return ResponseHelper::JsonDataResult($result);
}
public function getById(Request $request){
    $diskLocalName = StorageDisk::diskLocalName;
    $user = $this->service->getById($request->id);
    $arrRole = $this->service->getRole();
    if($user->avatar==NULL){
       $user->src = url('/')."/common_images/no-avatar.png";
   }else{
    $user->src = CommonHelper::getImageUrl($user->avatar);
}
return view("backend.users.edit",[
    "user" => $user,
    "arrRole" => $arrRole
]);
}
public function editPost(Request $request)
{
    $diskLocalName    = StorageDisk::diskLocalName;
    $image            = $request->file("image");
    $rule_image       = "";
    $rule_pass        = "";
    $rule_passConfirm = "";
    $result     =  new DataResultCollection();
    $currentRoleValue = AuthHelper::getUserInfor()->role_value;
    if($image!=NULL){
        $rule_image = "mimes:".UploadConst::FILE_IMAGE_UPLOAD_ACCESSED."|image|max:".UploadConst::BACKEND_UPLOAD_IMAGE_MAX;
    }
    if($request->changePass ==="1"){
        $rule_pass        = "required|min:4|max:32";
        $rule_passConfirm = "required|min:4|max:32|confirmed";
    }
    $rule = [
        "image" => $rule_image,
        "name"  => "required|min:3|max:32",
        "date"  => "required|date",
        "email" => "required|email|unique:users,email,".$request->id,
        "pass"  => $rule_pass,
        "password_confirmation" => $rule_passConfirm,
                // "role"  => ["required",new RoleLevelRule($currentRoleValue)],
        "rePass" => "compare:pass"
    ];
    $message_rule = [
        '*.mimes' => 'Mime not Allowed',
        "password_confirmation.confirmed" => "Password does not match the confirm password",
    ];
    $validator = Validator::make($request->all(), $rule,$message_rule);
    if (!$validator->fails()) {
            //check file image, if have process and save image
        if($image!=NULL){
                //delete image
            Storage::disk($diskLocalName)->delete($request->oldImgSrc);
            $result = $this->uploadService->uploadFile(array($image),$diskLocalName,'uploads/avatars','');
        }else{
            $result->status = SDBStatusCode::OK;
        }
    } else {
        $error = array($validator->errors());
        $result->status = SDBStatusCode::ValidateError;
        $result->message = 'An error occured while uploading avatar or validate!';
        $result->data =$error;
    }
    if($result->status==SDBStatusCode::OK){
        $obj         = new \stdClass();
        if($image!=NULL){
            foreach ($result->data as $data){
                $obj->image = $data["uri"];
            }
        }else{
            $obj->image = NULL;
        }
        if(isset($request->pass)){
            $obj->pass   = md5($request->pass);
        }
        $obj->id     = $request->id;
        $obj->name   = $request->name;
        $obj->date   = $request->date;
        $obj->gender = $request->gender;
        $obj->active = $request->active;
        $obj->email  = $request->email;
        $obj->role   = $request->role;
        $this->service->update($obj);
    }
    return ResponseHelper::JsonDataResult($result);
}
public function delete(Request $request){
    $this->service->delete($request->id);
}
public function deleteAll(Request $request){
    $this->service->deleteAll($request->arrUser);
}
}