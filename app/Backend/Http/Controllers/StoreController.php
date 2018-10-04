<?php

namespace App\Backend\Http\Controllers;
use App\Core\Helpers\CommonHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Core\Entities\DataResultCollection;
use App\Core\Services\Interfaces\UploadServiceInterface;
use App\Backend\Services\Interfaces\StoreServiceInterface;
use App\Core\Common\SDBStatusCode;
use App\Core\Common\UploadConst;
use App\Core\Common\StorageDisk;
use Illuminate\Support\Facades\Storage;
use App\Core\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Core\Helpers\AuthHelper;


class StoreController
{
    protected $storeService;
    protected $uploadService;
    protected $storeId;
    public function __construct(StoreServiceInterface $storeService,UploadServiceInterface $uploadService)
    {
        $this->storeService   = $storeService;
        $this->uploadService = $uploadService;
    }
    public function getAddStore(Request $request)
    {
        return view("backend.store.add");
    }
    public function postAddStore(Request $request)
    {
        $diskLocalName = StorageDisk::diskLocalName;
        $image      = $request->file("image");
        $result     =  new DataResultCollection();
        $rule_image = "";
        if($image!=NULL){
            $rule_image = "mimes:".UploadConst::FILE_IMAGE_UPLOAD_ACCESSED."|image|max:".UploadConst::BACKEND_UPLOAD_IMAGE_MAX;
        }
        $rule   = [
            "image"   => $rule_image,
            "name"    => "required|min:3",
            "lat"     => "required",
            "lng"    => "required",
            "address" => "required"
        ];
        $message_rule = [
            '*.mimes' => 'Mime not Allowed',
            "lat.required" => "The latitude is required!",
            "lng.required" => "The longtitude is required!",
        ];
        $validator = Validator::make($request->all(),$rule,$message_rule);
        if (!$validator->fails()) {
            if($image!=NULL){
                $result = $this->uploadService->uploadFile(array($image),$diskLocalName,'StoreImage/'.CommonHelper::getStoreId(),'');
                foreach ($result->data as $data){
                    $imageUrl = $data["uri"];
                }
            } else{
                $imageUrl       = NULL;
                $result->status = SDBStatusCode::OK;
            }
        } else {
            $error           = $validator->errors();
            $result->status  = SDBStatusCode::ValidateError;
            $result->message = 'An error occured while uploading avatar or validate!';
            $result->data    = $error;
        }
        if($result->status== SDBStatusCode::OK){
            //insert into table entity
            $obj                = Array();
            $obj["avatar"]      = $imageUrl;
            $obj["name"]        = $request->name;
            $obj["lat"]         = $request->lat;
            $obj["lng"]         = $request->lng;
            $obj["address"]     = $request->address;
            $obj["description"] = $request->description;
            $this->storeService->addStore($obj);
        }
        return ResponseHelper::JsonDataResult($result);
    }
    public function getEditStore(Request $request)
    {
        $diskLocalName = StorageDisk::diskLocalName;
        $storeId = CommonHelper::getStoreId();
        $store = $this->storeService->getMyStore($storeId);
        if($store->avatar==NULL){
           $store->src = url('/')."/common_images/no-store.png";
        }else{
            $store->src = CommonHelper::getImageUrl($store->avatar);
        }
        return view("backend.store.edit",["store" => $store]);
    }
    public function postEditStore(Request $request)
    {
        $image         = $request->file("image");
        $result        =  new DataResultCollection();
        $diskLocalName = StorageDisk::diskLocalName;
        $rule_image    = "";
        if($image!=NULL){
            $rule_image = "mimes:".UploadConst::FILE_IMAGE_UPLOAD_ACCESSED."|image|max:".UploadConst::BACKEND_UPLOAD_IMAGE_MAX;
        }
        $rule   = [
            "image"   => $rule_image,
            "name"    => "required|min:3",
            "lat"     => "required",
            "lng"    => "required",
            "address" => "required"
        ];
        $message_rule = [
            '*.mimes' => 'Mime not Allowed',
            "lat.required" => "The latitude is required!",
            "lng.required" => "The longtitude is required!",
        ];
        $validator = Validator::make($request->all(),$rule,$message_rule);
        if (!$validator->fails()) {
            if($image!=NULL){
                //Delete old image
                Storage::disk($diskLocalName)->delete($request->oldImage);
                $result = $this->uploadService->uploadFile(array($image),$diskLocalName,'StoreImage/'.CommonHelper::getStoreId(),'');
                foreach ($result->data as $data){
                    $imageUrl = $data["uri"];
                }
            } else{
                $imageUrl       = $request->oldImage;
                $result->status = SDBStatusCode::OK;
            }
            $result->status = SDBStatusCode::OK;
        } else {
            $error           = $validator->errors();
            $result->status  = SDBStatusCode::ValidateError;
            $result->message = 'An error occured while uploading avatar or validate!';
            $result->data    = $error;
        }
        if($result->status=="OK"){
            //update table entity
            $obj                = Array();
            $obj["id"]          = CommonHelper::getStoreId();
            $obj["avatar"]      = $imageUrl;
            $obj["name"]        = $request->name;
            $obj["lat"]         = $request->lat;
            $obj["lng"]         = $request->lng;
            $obj["address"]     = $request->address;
            $obj["description"] = $request->description;
            $this->storeService->editStore($obj);
        }
        return ResponseHelper::JsonDataResult($result);
    }
}
