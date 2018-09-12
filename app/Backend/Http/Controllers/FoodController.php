<?php

namespace App\Backend\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Core\Entities\DataResultCollection;
use App\Core\Services\Interfaces\UploadServiceInterface;
use App\Backend\Services\Interfaces\FoodServiceInterface;
use App\Core\Common\SDBStatusCode;
use App\Core\Common\UploadConst;
use Illuminate\Support\Facades\Storage;
use App\Core\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use DateTime;

class FoodController
{
    protected $foodService;
    protected $uploadService;
    public function __construct(FoodServiceInterface $foodService,UploadServiceInterface $uploadService)
    {
        $this->foodService   = $foodService;
        $this->uploadService = $uploadService;
    }
    //Foods
    public function getFood()
    {
        $arrFood = $this->foodService->getFood(1);
        return view("backend.food.list",["arrFood" => $arrFood]);
    }
    public function getAddFood(Request $request)
    {
        $arrType = $this->foodService->getType(1);
        $arrMenu = $this->foodService->getMenu(1);
        return view("backend.food.add",[
            "arrType" => $arrType,
            "arrMenu" => $arrMenu
        ]);
    }
    public function postAddFood(Request $request)
    {
        $result    = new DataResultCollection();
        $rule      = [
            "label"    => "required|min:3",
            "type"     => "required",
            "dataFood" => "required"
        ];
        $validator = Validator::make($request->all(),$rule);
        if(!$validator->fails()){
            $this->service->addFood($request->all());
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

    public function getEditFood(Request $request)
    {
        $obj = $this->service->getById($request->id);
        return view("backend.Food.edit",["obj" => $obj]);
    }

    public function postEditFood(Request $request)
    {
        $result    = new DataResultCollection();
        $rule      = ["name" => "required|min:3"];
        $validator = Validator::make($request->all(),$rule);
        if(!$validator->fails()){
            $obj              = new \stdClass();
            $obj->id          = $request->id;
            $obj->name        = $request->name;
            $obj->description = $request->description;
            $this->service->editFood($obj);
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
    public function getProp(Request $request)
    {
        $arrProp = $this->foodService->getProp($request->idType);
        return $arrProp;
    }
    public function deleteFood(Request $request)
    {
        $this->service->deleteFood($request->id);
    }
    public function deleteAllFood(Request $request)
    {
        $this->service->deleteAllFood($request->arrId);
    }
}