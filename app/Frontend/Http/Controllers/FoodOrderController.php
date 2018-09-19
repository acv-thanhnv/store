<?php

namespace App\Frontend\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Api\V1\Services\Interfaces\FoodServiceInterface;
use Illuminate\Support\Facades\DB;
class FoodOrderController extends Controller
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

    public function index($storeId)
    {  

        return view('frontend.foodorder.index',["storeId" => $storeId]);
    }

    public function getLocations()
    {
        $location = DB::table('store_location')->select('id', 'name')->get();
    return view('frontend.foodorder.table', ['location' => $location]);
    }

    public function getDetail()
    {
        $detail = DB::table('store_entities')->get();
        return view('frontend.foodorder.detail', ['detail'=>$detail]);
    }


}
