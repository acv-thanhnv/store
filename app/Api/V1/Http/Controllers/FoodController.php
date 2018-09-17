<?php

namespace App\Api\V1\Http\Controllers;
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
    public function __construct(FoodServiceInterface $foodService)
    {
        $this->service = $foodService;
    }
    public function listByStore($storeId = null){
        $list = $this->service->getFoodByStoreId($storeId);
        $result  = new DataResultCollection ();
        $result->status =  SDBStatusCode::OK;
        $result->data = $list;
        return ResponseHelper::JsonDataResult($result);
    }
    public function listByMenu($menuId=null){
        $list = $this->service->getFoodByMenuId($menuId);
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
    public function order(Request $request){
        $result = $this->service->orderToWaiter($request);
        return ResponseHelper::JsonDataResult($result);
    }
    public function orderToChef(Request $request){
        $result  = $this->service->orderToChef($request);
        return ResponseHelper::JsonDataResult($result);
    }
    public function closeOrder(Request $request){
        $result = $this->service->closeOrder($request);
        return ResponseHelper::JsonDataResult($result);
    }
    public function orderWaiterList(){
        $storeId = CommonHelper::getStoreId();
        $orderDate= date('y/m/d');
        $result = $this->service->getOrderList($storeId,OrderStatusValue::Waiter,$orderDate,null,null);
        return ResponseHelper::JsonDataResult($result);
    }
    public function orderChefList(){
        $storeId = CommonHelper::getStoreId();
        $orderDate= date('y/m/d');
        $result = $this->service->getOrderList($storeId,OrderStatusValue::Cheft,$orderDate,null,null);
        return ResponseHelper::JsonDataResult($result);
    }
    public function orderClosedList(){
        $storeId = CommonHelper::getStoreId();
        $orderDate= date('y/m/d');
        $result = $this->service->getOrderList($storeId,OrderStatusValue::Close,$orderDate,null,null);
        return ResponseHelper::JsonDataResult($result);
    }
    public function orderHistoryList(Request $request){
        $storeId = CommonHelper::getStoreId();
        $page = $request->input('page');
        $pageSize = $request->input('pageSize');
        $result = $this->service->getOrderList($storeId,null,null,$page,$pageSize);
        return ResponseHelper::JsonDataResult($result);
    }
}
