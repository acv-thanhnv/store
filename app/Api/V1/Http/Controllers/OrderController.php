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
use Illuminate\Support\Facades\Auth;

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
}
