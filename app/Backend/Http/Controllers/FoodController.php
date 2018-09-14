<?php

namespace App\Backend\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Core\Entities\DataResultCollection;
use App\Core\Services\Interfaces\UploadServiceInterface;
use App\Backend\Services\Interfaces\FoodServiceInterface;
use App\Backend\Services\Interfaces\TypeServiceInterface;
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
    protected $typeService;
    protected $uploadService;
    public function __construct(FoodServiceInterface $foodService,UploadServiceInterface $uploadService,TypeServiceInterface $typeService)
    {
        $this->foodService   = $foodService;
        $this->typeService   = $typeService;
        $this->uploadService = $uploadService;
    }
    //Foods
    public function getFood()
    {
        $diskLocalName = "public";
        $arrFood = $this->foodService->getFood(1);
        foreach($arrFood as $obj)
        {
            if($obj->image==NULL){
                $obj->image = url('/')."/common_images/no-image.png";
            }else{
                $obj->image = Storage::disk($diskLocalName)->url($obj->image);
            }
        }
        return view("backend.food.list",["arrFood" => $arrFood]);
    }
    public function getAddFood(Request $request)
    {
        $arrType = $this->foodService->getType(1);
        $arrMenu = $this->foodService->getMenu(1);
        $arrData = $this->foodService->getDataType();
        return view("backend.food.add",[
            "arrType" => $arrType,
            "arrMenu" => $arrMenu, 
            "arrData" => $arrData
        ]);
    }
    public function postAddFood(Request $request)
    {
        $arrProp = json_decode($request->arrProp);//encode from FormData
        $image      = $request->file("image");
        $result     =  new DataResultCollection();
        $rule_image = "";
        if($image!=NULL){
            $rule_image = "mimes:".UploadConst::FILE_IMAGE_UPLOAD_ACCESSED."|image|max:".UploadConst::BACKEND_UPLOAD_IMAGE_MAX;
        }
        $rule   = [
            "image" => $rule_image,
            "name"  => "required|min:3",
            "price" => "required|int",
            "menu"  => "required",
        ];
        $message_rule = [
            '*.mimes' => 'Mime not Allowed'
        ];
        $validator = Validator::make($request->all(),$rule,$message_rule);
        if (!$validator->fails()) {
            if($image!=NULL){
                $result = $this->uploadService->uploadFile(array($image),'public','FoodImage/'.$request->idStore,'');
                foreach ($result->data as $data){
                    $imageUrl = $data["uri"];
                }
            } else{
                $imageUrl       = NULL;
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
            //insert into table entity
            $obj            = Array();
            $obj["image"]   = $imageUrl;
            $obj["name"]    = $request->name; 
            $obj["price"]   = $request->price;
            $obj["menu_id"] = $request->menu; 
            $idFood         = $this->foodService->addFood($obj);
            // insert into table store_entity_properties
            $prop = Array();
            $arrIdProp = Array();
            //add Property
            if($arrProp!=NULL){
                foreach ($arrProp as $objProp) {
                    if($objProp->label!=NULL){
                        $prop["property_name"]    = changeTitle($objProp->label);
                        $prop["data_type_code"]   = $objProp->data;
                        $prop["property_label"]   = $objProp->label;
                        $prop["sort"]             = (int) $objProp->sort;
                        $idProp         = $this->foodService->addProp($prop);
                        $propValue                = Array();
                        $propValue["entity_id"]   = $idFood;
                        $propValue["property_id"] = $idProp;
                        $propValue["value"]       = $objProp->value;
                        $this->foodService->addPropValue($propValue);
                    }
                }
            }
        }
        return ResponseHelper::JsonDataResult($result);
    }

    public function getEditFood(Request $request)
    {
        $diskLocalName = "public";
        $arrMenu = $this->foodService->getMenu(1);
        $arrData = $this->foodService->getDataType();
        $food = $this->foodService->getById($request->id);
        if($food->image==NULL){
           $food->src = url('/')."/common_images/no-image.png"; 
        }else{
            $food->src = Storage::disk($diskLocalName)->url($food->image);
        }
        $food->arrProp = $this->foodService->getPropByFood($food->id);
        return view("backend.food.edit",[
            "food" => $food,
            "arrMenu" => $arrMenu,
            "arrData" => $arrData
        ]);
    }
    public function postEditFood(Request $request)
    {
        // dd($request->all());
        $arrProp       = json_decode($request->arrProp);//encode from FormData
        $image         = $request->file("image");
        $result        =  new DataResultCollection();
        $diskLocalName = "public";
        $rule_image    = "";
        if($image!=NULL){
            $rule_image = "mimes:".UploadConst::FILE_IMAGE_UPLOAD_ACCESSED."|image|max:".UploadConst::BACKEND_UPLOAD_IMAGE_MAX;
        }
        $rule   = [
            "image" => $rule_image,
            "name"  => "required|min:3",
            "price" => "required",
            "menu"  => "required",
        ];
        $message_rule = [
            '*.mimes' => 'Mime not Allowed'
        ];
        $validator = Validator::make($request->all(),$rule,$message_rule);
        if (!$validator->fails()) {
            if($image!=NULL){
                //Delete old image
                Storage::disk($diskLocalName)->delete($request->oldImage);
                $result = $this->uploadService->uploadFile(array($image),$diskLocalName,'FoodImage/'.$request->idStore,'');
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
            $obj            = Array();
            $obj["image"]   = $imageUrl;
            $obj["id"]      = $request->id;
            $obj["name"]    = $request->name; 
            $obj["price"]   = (int) $request->price;
            $obj["menu_id"] = $request->menu;
            $this->foodService->editFood($obj);
            // update table store_entity_properties
            $prop      = Array();
            $propValue = Array();
            //if isset:update else add Property
            if($arrProp!=NULL){
                foreach ($arrProp as $objProp) {
                    // dd($objProp);
                    if($objProp->label!=NULL){
                        //get property
                        $prop["property_name"]  = changeTitle($objProp->label);
                        $prop["data_type_code"] = $objProp->data;
                        $prop["property_label"] = $objProp->label;
                        $prop["sort"]           = (int) $objProp->sort;
                        //get property values
                        $propValue["entity_id"]   = $request->id;
                        $propValue["value"]       = $objProp->value;
                        if(isset($objProp->idProp)){//if have id property)
                            $prop["id"]      = (int) $objProp->idProp;
                            $propValue["id"] = (int) $objProp->idValue;
                            $this->typeService->editProp($prop);
                            $this->foodService->editPropValue($propValue);
                        }else{
                            unset($prop["id"]);
                            unset($propValue["id"]);
                            $propValue["property_id"] = $this->foodService->addProp($prop);
                            $this->foodService->addPropValue($propValue);
                        }
                    }
                }
            }
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
        $this->foodService->deleteFood($request->id);
    }
    public function deleteFoodProp(Request $request)
    {
        $this->foodService->deleteFoodProp($request->id);
    }
    public function deleteAllFood(Request $request)
    {
        $this->foodService->deleteAllFood($request->arrId);
    }
}