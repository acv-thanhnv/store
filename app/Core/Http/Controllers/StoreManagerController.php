<?php
/**
 * Created by PhpStorm.
 * User: SonMT
 * Date: 11/9/2018
 * Time: 2:02 PM
 */

namespace App\Core\Http\Controllers;
use App\Backend\Services\Interfaces\StoreManagerInterface;
use App\Backend\Services\Production\StoreManagerService;
use App\Core\Helpers\CommonHelper;
use App\Core\Entities\DataResultCollection;
use App\Core\Common\SDBStatusCode;
use App\Core\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;
use Illuminate\Support\Facades\Validator;

class StoreManagerController
{
    protected $storeService;

    public function __construct(StoreManagerInterface $storeService)
    {
        $this->storeService   = $storeService;
    }
    public function getStoreManager(Request $request){
        $store          = $this->storeService->getStoreManager();
        $result         = new DataResultCollection();
        $result->status = SDBStatusCode::OK;
        $result->data   = $store;
        return view("backend.store_manager.list",["store" =>$result]);
    }
    public function addStoreManager(Request $request)
    {
        return view("backend.store_manager.add");
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
            $this->storeService->addFloor($obj);
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

    public function getEditStoreManager(Request $request)
    {
        $obj = $this->storeService->getById($request->id);
        return view("backend.store_manager.edit",["obj" => $obj]);
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
            $this->storeService->editFloor($obj);
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
    public function deleteStoreManager(Request $request)
    {
        $this->storeService->deleteFloor($request->id);
    }
    public function deleteAllStoreManager(Request $request)
    {
        $this->storeService->deleteAllFloor($request->arrId);
    }


}