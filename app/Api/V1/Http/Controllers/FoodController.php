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
    public function listByMenu($menuId=null, Request $request){
        $storeId= isset($request->input('storeId')) ? $request->input('storeId') :0;
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
}
