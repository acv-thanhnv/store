<?php

namespace App\Api\V1\Http\Controllers;
use App\Core\Common\SDBStatusCode;
use App\Api\V1\Services\Interfaces\FoodServiceInterface;
use App\Core\Entities\DataResultCollection;
use App\Core\Events\OrderPusherEvent;
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
        $this->service->orderToWaiter($request);
        $result  = new DataResultCollection ();
        $result->status =  SDBStatusCode::OK;
    }
    public function orderToChef(Request $request){
        $this->service->orderToChef($request);
        $result  = new DataResultCollection ();
        $result->status =  SDBStatusCode::OK;
    }
    public function closeOrder(Request $request){
        $this->service->closeOrder($request);
        $result  = new DataResultCollection ();
        $result->status =  SDBStatusCode::OK;
    }
}
