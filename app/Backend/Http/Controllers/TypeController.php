<?php

namespace App\Backend\Http\Controllers;
use App\Core\Helpers\CommonHelper;
use Illuminate\Support\Facades\Route;
use App\Core\Entities\DataResultCollection;
use App\Core\Services\Interfaces\UploadServiceInterface;
use App\Backend\Services\Interfaces\TypeServiceInterface;
use App\Core\Common\SDBStatusCode;
use App\Core\Common\UploadConst;
use Illuminate\Support\Facades\Storage;
use App\Core\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use DateTime;

class TypeController
{
    protected $service;
    protected $uploadService;
    public function __construct(TypeServiceInterface $typeService,UploadServiceInterface $uploadService)
    {
        $this->service       = $typeService;
        $this->uploadService = $uploadService;
    }
    //Type
    public function getType()
    {
        $storeId = CommonHelper::getStoreId();
        $arrType = $this->service->getType($storeId);
        foreach ($arrType as $type) {
            $prop = $this->service->getProp($type->id);
            if(count($prop)===0){
                $type->prop = NULL;
            }else{
                $type->prop = $prop;
            }
        }
        return view("backend.type.list",["arrType" => $arrType]);
    }
    public function getAddType()
    {
        $arrData = $this->service->getDataType();
        return view("backend.type.add",["arrData" => $arrData]);
    }
    public function postAddType(Request $request)
    {
        $result    = new DataResultCollection();
        $rule      = ["name" => "required|min:3"];
        $validator = Validator::make($request->all(),$rule);
        if(!$validator->fails()){
            $type              = Array();
            $prop              = Array();
            //adType
            $type["name"]        = $request->name;
            $type["store_id"]    = CommonHelper::getStoreId();
            $type["description"] = $request->description;
            $idType = $this->service->addType($type);
            //add Property
            if($request->arrProp!=NULL){
                foreach ($request->arrProp as $obj) {
                    if($obj["label"]!=NULL){
                        $prop["entity_type_id"] = $idType;
                        $prop["property_name"] = CommonHelper::changeTitle($obj["label"]);
                        $prop["data_type_code"] = $obj["data"];
                        $prop["property_label"] = $obj["label"];
                        $prop["sort"] = $obj["sort"];
                        $this->service->addProp($prop);
                    }
                }
            }
            $result->status   = SDBStatusCode::OK;
            $result->message  = 'Success';
        }else {
            $error           = $validator->errors();
            $result->status  = SDBStatusCode::ValidateError;
            $result->message = 'An error occured when validate!';
            $result->data    = $error;
        }
        return ResponseHelper::JsonDataResult($result);
    }

    public function getEditType(Request $request)
    {
        $obj  = $this->service->getById($request->id);
        $prop =  $this->service->getProp($obj->id);
        $obj->arrProp = $prop;
        $arrData      = $this->service->getDataType();
        return view("backend.type.edit",[
            "obj"     => $obj,
            "arrData" => $arrData
        ]);
    }

    public function postEditType(Request $request)
    {
        $result    = new DataResultCollection();
        $rule      = ["name" => "required|min:3"];
        $validator = Validator::make($request->all(),$rule);
        if(!$validator->fails()){
            $type              = Array();
            $prop              = Array();
            //adType
            $type["id"]          = $request->id;
            $type["name"]        = $request->name;
            $type["store_id"]    = CommonHelper::getStoreId();
            $type["description"] = $request->description;
            $idType = $this->service->editType($type);
            //add Property
            if($request->arrProp!=NULL){
                foreach ($request->arrProp as $obj) {
                    if($obj["label"]!=NULL){
                        $prop["entity_type_id"] = $request->id;
                        $prop["property_name"] = CommonHelper::changeTitle($obj["label"]);
                        $prop["data_type_code"] = $obj["data"];
                        $prop["property_label"] = $obj["label"];
                        $prop["sort"] = $obj["sort"];
                        if(isset($obj["id"])){
                            $prop["id"] = $obj["id"];
                            $this->service->editProp($prop);
                        }else{
                            unset($prop["id"]);
                            $this->service->addProp($prop);
                        }
                    }
                }
            }
            $result->status   = SDBStatusCode::OK;
            $result->message  = 'Success';
        }else {
            $error           = $validator->errors();
            $result->status  = SDBStatusCode::ValidateError;
            $result->message = 'An error occured when validate!';
            $result->data    = $error;
        }
        return ResponseHelper::JsonDataResult($result);
    }
    public function deleteType(Request $request)
    {
        $this->service->deleteType($request->id);
    }
    public function deleteAllType(Request $request)
    {
        $this->service->deleteAllType($request->arrId);
    }
    public function deleteProp(Request $request)
    {
        $this->service->deleteProp($request->id);
    }

}
