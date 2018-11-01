<?php

namespace App\Api\V1\Http\Controllers;
use App\Api\V1\Services\Interfaces\OrderServiceInterface;
use App\Core\Common\OrderStatusValue;
use App\Core\Common\SDBStatusCode;
use App\Api\V1\Services\Interfaces\FoodServiceInterface;
use App\Core\Entities\DataResultCollection;
use App\Core\Events\OrderPusherEvent;
use App\Core\Helpers\CommonHelper;
use App\Core\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    protected $service;
    protected $orderService;
    public function __construct(FoodServiceInterface $foodService, OrderServiceInterface $orderService)
    {
        $this->service = $foodService;
        $this->orderService = $orderService;
    }
    public function listByStore($storeId = null){
        $list = $this->service->getFoodByStoreId($storeId);
        $result  = new DataResultCollection ();
        $result->status =  SDBStatusCode::OK;
        $result->data = $list;
        return ResponseHelper::JsonDataResult($result);
    }
    public function listByMenu(Request $request,$menuId=null){
        $storeId =   $request->input('idStore');
        $list = $this->service->getFoodByMenuId($menuId,$storeId);
        $result  = new DataResultCollection ();
        $result->status =  SDBStatusCode::OK;
        $result->data = $list;
        return ResponseHelper::JsonDataResult($result);
    }
    public function listMenu($storeId=null){
        $list = $this->service->getMenuList($storeId);
        $result  = new DataResultCollection ();
        $result->status =  SDBStatusCode::OK;
        $result->data = $list;
        return ResponseHelper::JsonDataResult($result);
    }

    public function listFloors(Request $request)
    {
        $idStore=$request->idStore;
        $list = $this->service->getFloorsByStore($idStore);
        $result = new DataResultCollection();
        $result->status = SDBStatusCode::OK;
        $result->data=$list;
        return ResponseHelper::JsonDataResult($result);
    }

    public function listTableByFloor(Request $request)
    {
        $idFloor = $request->idFloor;
        $idStore = $request->idStore;
        $list = $this->service->getLocationbyFloor($idFloor,$idStore);
        $result = new DataResultCollection();
        $result->status = SDBStatusCode::OK;
        $result->data=$list;
        return ResponseHelper::JsonDataResult($result);
    }

    public function getLocation(Request $request){
        $idStore = $request->idStore;
        $list = $this->service->getLocation($idStore);
        $result = new DataResultCollection();
        $result->status = SDBStatusCode::OK;
        $result->data=$list;
        return ResponseHelper::JsonDataResult($result);
    }

    public function getOrderByLocation(Request $request){
        $idLocation = $request->idLocation;
        $idStore = $request->idStore;
        $list = $this->service->getOrderByLocation($idLocation, $idStore);
        $result = new DataResultCollection();
        $result->status = SDBStatusCode::OK;
        $result->data=$list;
        return ResponseHelper::JsonDataResult($result);
    }

    public function getOrderDetail(Request $request){
        $idOrder = $request->idOrder;
        $list = $this->service->getOrderDetail($idOrder);
        $result = new DataResultCollection();
        $result->status = SDBStatusCode::OK;
        $result->data=$list;
        return ResponseHelper::JsonDataResult($result);
    }
}
