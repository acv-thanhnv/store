<?php

namespace App\Api\V1\Http\Controllers;
use App\Api\V1\Services\Interfaces\OrderServiceInterface;
use App\Core\Common\OrderConst;
use App\Core\Common\OrderStatusValue;
use App\Core\Common\SDBStatusCode;
use App\Core\Entities\DataResultCollection;
use App\Core\Events\OrderPusherEvent;
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
        $orderId = $request->input('orderId');
        $result = $this->service->deleteOrder($request,OrderStatusValue::Waiter);
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
