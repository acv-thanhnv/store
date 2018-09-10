<?php

namespace App\Backend\Http\Controllers;
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
        $arrType = $this->service->getType(1);
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
        return view("backend.type.add");
    }
    public function postAddType(Request $request)
    {
        $result    = new DataResultCollection();
        $rule      = ["name" => "required|min:3"];
        $validator = Validator::make($request->all(),$rule);
        if(!$validator->fails()){
            $this->service->addType($request->all());
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
        $obj = $this->service->getById($request->id);
        return view("backend.type.edit",["obj" => $obj]);
    }

    public function postEditType(Request $request)
    {
        $result    = new DataResultCollection();
        $rule      = ["name" => "required|min:3"];
        $validator = Validator::make($request->all(),$rule);
        if(!$validator->fails()){
            $obj              = new \stdClass();
            $obj->id          = $request->id;
            $obj->name        = $request->name;
            $obj->description = $request->description;
            $this->service->editType($obj);
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
}