<?php

namespace App\Api\V1\Http\Controllers;
use App\Core\Common\SDBStatusCode;
use App\Api\V1\Services\Interfaces\FoodServiceInterface;
use App\Core\Entities\DataResultCollection;
use App\Core\Helpers\ResponseHelper;
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
        $result->message = $storeId;
        return ResponseHelper::JsonDataResult($result);
    }
}
