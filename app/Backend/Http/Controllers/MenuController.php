<?php

namespace App\Backend\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Core\Entities\DataResultCollection;
use App\Core\Services\Interfaces\UploadServiceInterface;
use App\Backend\Services\Interfaces\MenuServiceInterface;
use App\Core\Common\SDBStatusCode;
use App\Core\Common\UploadConst;
use Illuminate\Support\Facades\Storage;
use App\Core\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use DateTime;

class MenuController
{
    protected $service;
    protected $uploadService;
    public function __construct(MenuServiceInterface $menuService,UploadServiceInterface $uploadService)
    {
        $this->service       = $menuService;
        $this->uploadService = $uploadService;
    }
	public function getMenu()
    {
        $arrMenu = $this->service->getMenu(1);
        return view("backend.menu.list",["arrMenu" => $arrMenu]);
    }
    public function getAddMenu()
    {
        return view("backend.menu.add");
    }
    public function postAddMenu(Request $request)
    {
        $result    = new DataResultCollection();
        $rule      = ["name" => "required|min:3"];
        $validator = Validator::make($request->all(),$rule);
        if(!$validator->fails()){
            $this->service->addMenu($request->all());
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

    public function getEditMenu(Request $request)
    {
        $obj = $this->service->getById($request->id);
        return view("backend.menu.edit",["obj" => $obj]);
    }

    public function postEditMenu(Request $request)
    {
        $result    = new DataResultCollection();
        $rule      = ["name" => "required|min:3"];
        $validator = Validator::make($request->all(),$rule);
        if(!$validator->fails()){
            $obj              = new \stdClass();
            $obj->id          = $request->id;
            $obj->name        = $request->name;
            $obj->description = $request->description;
            $this->service->editMenu($obj);
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
    public function deleteMenu(Request $request)
    {
        $this->service->deleteMenu($request->id);
    }
    public function deleteAllMenu(Request $request)
    {
        $this->service->deleteAllMenu($request->arrId);
    }
}