<?php
/**
 * Created by PhpStorm.
 * User: SonMT
 * Date: 11/2/2018
 * Time: 10:53 AM
 */

namespace App\Backend\Http\Controllers;
use App\Backend\Services\Interfaces\FloorServiceInterface;
use App\Backend\Services\Production\FloorService;
use App\Core\Helpers\CommonHelper;
use App\Core\Entities\DataResultCollection;
use App\Core\Common\SDBStatusCode;
use App\Core\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;
use Illuminate\Support\Facades\Validator;


class FloorController
{
    protected $floorService;
    protected $storeId;
    public function __construct(FloorServiceInterface $floorService)
    {
        $this->floorService   = $floorService;
    }
    public function getMyFloor(Request $request){
        $storeId = CommonHelper::getStoreId();;
        $floor= $this->floorService->getMyFloor($storeId);
        $result = new DataResultCollection();
        $result->status = SDBStatusCode::OK;
        $result->data=$floor;
        return view("backend.floor.list",["floor" =>$result]);
    }
    public function getAddFloor(Request $request)
    {
        return view("backend.floor.add");
    }

    public function postAddFloor(Request $request)
    {
        $result             = new DataResultCollection();
        $rule               = ["name" => "required|min:3"];
        $validator          = Validator::make($request->all(),$rule);
        $storeId = 1;
        $obj=array([
            'store_id'=>$storeId,
            'name'=>$request->name
        ]);
        if(!$validator->fails()){
            $this->floorService->addFloor($obj);
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

    public function getEditFloor(Request $request)
    {
        $obj = $this->floorService->getById($request->id);
        return view("backend.floor.edit",["obj" => $obj]);
    }

    public function update(Request $request)
    {
        $result    = new DataResultCollection();
        $rule      = ["name" => "required|min:3"];
        $validator = Validator::make($request->all(),$rule);
        if(!$validator->fails()){
            $obj              = new \stdClass();
            $obj->id          = $request->id;
            $obj->name        = $request->name;
            $this->floorService->editFloor($obj);
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
    public function deleteFloor(Request $request)
    {
        $this->floorService->deleteFloor($request->id);
    }
    public function deleteAllFloor(Request $request)
    {
        $this->floorService->deleteAllFloor($request->arrId);
    }

}