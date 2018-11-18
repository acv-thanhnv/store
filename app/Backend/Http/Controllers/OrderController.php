<?php

namespace App\Backend\Http\Controllers;
use App\Backend\Services\Interfaces\OrderServiceInterface;
use App\Core\Common\OrderStatusValue;
use App\Core\Helpers\CommonHelper;
use App\Core\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $service;
    public function __construct( OrderServiceInterface $orderService)
    {
        $this->service = $orderService;
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
    public function orderDeleteWaiter(Request $request){
        $storeId = CommonHelper::getStoreId();
        $result = $this->service->deleteOrder($request,$storeId,OrderStatusValue::Waiter);
        return ResponseHelper::JsonDataResult($result);
    }
    public function orderDeleteChef(Request $request){
        $storeId = CommonHelper::getStoreId();
        $result = $this->service->deleteOrder($request,$storeId,OrderStatusValue::Cheft);
        return ResponseHelper::JsonDataResult($result);
    }
    public function orderDeleteClosed(Request $request){
        $storeId = CommonHelper::getStoreId();
        $result = $this->service->deleteOrder($request,$storeId,OrderStatusValue::Close);
        return ResponseHelper::JsonDataResult($result);
    }
    public function orderDeleteHistory(Request $request){
        $storeId = CommonHelper::getStoreId();
        $result = $this->service->deleteOrder($request,$storeId,null);
        return ResponseHelper::JsonDataResult($result);
    }

    public function orderWaiterList(){
        $storeId = CommonHelper::getStoreId();
        $orderDate= date('Y/m/d');
        $result = $this->service->getOrderList($storeId,OrderStatusValue::Waiter,$orderDate,null,null);
        return ResponseHelper::JsonDataResult($result);
    }
    public function orderChefList(){
        $storeId = CommonHelper::getStoreId();
        $orderDate= date('Y/m/d');
        $result = $this->service->getOrderList($storeId,OrderStatusValue::Cheft,$orderDate,null,null);
        return ResponseHelper::JsonDataResult($result);
    }
    public function orderClosedList(){
        $storeId = CommonHelper::getStoreId();
        $orderDate= date('Y/m/d');
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
