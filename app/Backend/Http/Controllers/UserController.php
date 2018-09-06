<?php

namespace App\Backend\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Core\Entities\DataResultCollection;
use App\Core\Services\Interfaces\UploadServiceInterface;
use App\Core\Common\SDBStatusCode;
use App\Core\Common\UploadConst;
use Illuminate\Support\Facades\Storage;
use App\Backend\Services\Interfaces\UserServiceInterface;
use App\Core\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use DateTime;

class UserController
{
	protected $service;
    protected $uploadService;
    public function __construct(UserServiceInterface $userService,UploadServiceInterface $uploadService)
    {
        $this->service       = $userService;
        $this->uploadService = $uploadService;
    }
    public function getList(){
    	return view("backend.users.list");
    }
    public function profile(Request $request){
        $diskLocalName = "public";
        $user = $this->service->getById($request->id);
        if($user->avatar==NULL){
           $user->src = url('/')."/common_images/no-avatar.png"; 
        }else{
            $user->src = Storage::disk($diskLocalName)->url($user->avatar);
        }
        return view("backend.users.profile",["user" => $user]);
    }
    public function paginate(){
        $diskLocalName = 'public';
    	$arrUser = $this->service->getAll();
        foreach($arrUser as $obj)
        {
            if($obj->avatar==NULL){
                $obj->avatar = url('/')."/common_images/no-avatar.png";
            }else{
                $obj->avatar = Storage::disk($diskLocalName)->url($obj->avatar);
            }
        }
    	return response()->json(["data" => $arrUser]);
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
                $result = $this->uploadService->uploadFile(array($image),'public','uploads/avatars','');
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
        if($result->status=="OK"){
            $obj        = new \stdClass();
            $obj->image = NULL;
            if($image!=NULL){
                $obj->image  = $imageUrl;
            }
            $obj->name   = $request->name; 
            $obj->date   = $request->date;
            $obj->gender = $request->gender; 
            $obj->email  = $request->email;
            $obj->pass   = md5($request->pass);
            $obj->role   = $request->role;
            $this->service->insert($obj);
        }
        return ResponseHelper::JsonDataResult($result);
    }
    public function getById(Request $request){
        $diskLocalName = "public";
        $user = $this->service->getById($request->id);
        $arrRole = $this->service->getRole();
        if($user->avatar==NULL){
           $user->src = url('/')."/common_images/no-avatar.png"; 
        }else{
            $user->src = Storage::disk($diskLocalName)->url($user->avatar);
        }
        return view("backend.users.edit",[
            "user" => $user, 
            "arrRole" => $arrRole
        ]);
    }
    public function editPost(Request $request)
    {   
        $diskLocalName    = "public";
        $image            = $request->file("image");
        $rule_image       = "";
        $rule_pass        = "";
        $rule_passConfirm = "";
        $result     =  new DataResultCollection();
        if($image!=NULL){
            $rule_image = "mimes:".UploadConst::FILE_IMAGE_UPLOAD_ACCESSED."|image|max:".UploadConst::BACKEND_UPLOAD_IMAGE_MAX;
        }
        if($request->changePass ==="1"){
            $rule_pass = "required|min:4|max:32";
            $rule_passConfirm = "required|min:4|max:32|confirmed";
        }
        $rule = [
                "image" => $rule_image,
                "name"  => "required|min:3|max:32",
                "date"  => "required|date",
                "email" => "required|email|unique:users,email,".$request->id,
                "pass"  => $rule_pass,
                "password_confirmation" => $rule_passConfirm,
                "role"  => "required",
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
                $result = $this->uploadService->uploadFile(array($image),'public','uploads/avatars','');
            }else{
                $result->status = SDBStatusCode::OK;
            }
        } else {
            $error = array($validator->errors());
            $result->status = SDBStatusCode::ValidateError;
            $result->message = 'An error occured while uploading avatar or validate!';
            $result->data =$error;
        }
        if($result->status=="OK"){
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