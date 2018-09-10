<?php

namespace App\Backend\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Core\Entities\DataResultCollection;
use App\Core\Services\Interfaces\UploadServiceInterface;
use App\Backend\Services\Interfaces\PropServiceInterface;
use App\Core\Common\SDBStatusCode;
use App\Core\Common\UploadConst;
use Illuminate\Support\Facades\Storage;
use App\Core\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use DateTime;

class PropController
{
    protected $service;
    protected $uploadService;
    public function __construct(PropServiceInterface $propService,UploadServiceInterface $uploadService)
    {
        $this->service       = $propService;
        $this->uploadService = $uploadService;
    }
    //Prop
    public function getProp()
    {
        $arrProp = $this->service->getProp(1);
        return view("backend.prop.list",["arrProp" => $arrProp]);
    }
    public function getAddProp()
    {
        $arrType = $this->service->getType(1);
        $arrData = $this->service->getDataType();
        return view("backend.prop.add",[
            "arrType" => $arrType, 
            "arrData" => $arrData
        ]);
    }
    public function postAddProp(Request $request)
    {
        $result    = new DataResultCollection();
        $rule      = [
            "label"    => "required|min:3",
            "type"     => "required",
            "dataProp" => "required"
        ];
        $validator = Validator::make($request->all(),$rule);
        if(!$validator->fails()){
            $this->service->addProp($request->all());
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

    public function getEditProp(Request $request)
    {
        $obj = $this->service->getById($request->id);
        return view("backend.Prop.edit",["obj" => $obj]);
    }

    public function postEditProp(Request $request)
    {
        $result    = new DataResultCollection();
        $rule      = ["name" => "required|min:3"];
        $validator = Validator::make($request->all(),$rule);
        if(!$validator->fails()){
            $obj              = new \stdClass();
            $obj->id          = $request->id;
            $obj->name        = $request->name;
            $obj->description = $request->description;
            $this->service->editProp($obj);
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
    public function deleteProp(Request $request)
    {
        $this->service->deleteProp($request->id);
    }
    public function deleteAllProp(Request $request)
    {
        $this->service->deleteAllProp($request->arrId);
    }
}