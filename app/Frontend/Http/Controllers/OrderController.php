<?php

namespace App\Frontend\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Api\V1\Services\Interfaces\FoodServiceInterface;

class OrderController extends Controller
{   

    protected $foodService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    public function __construct(FoodServiceInterface $foodService)
    {
        $this->foodService = $foodService;
    }

    public function index()
    {  
        return view('layouts.order');
    }

    public function getFoodByStoreID()
    {
        $list = $this->foodService->getFoodByStoreId(1);
        return $list;
    }

    public function getFoodByMenuID()
    {
        $arrType = $this->foodService->getFoodByStoreId(1);
    }


}
