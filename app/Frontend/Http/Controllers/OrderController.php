<?php

namespace App\Frontend\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Api\V1\Services\Interfaces\FoodServiceInterface;
use Illuminate\Support\Facades\DB;
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

    public function index($idStore)
    {  
        return view('frontend.order.index',["idStore" => $idStore]);
    }

    public function index2(){
        return view('frontend.foodorder.index');
    }

    public function getTables()
    {
        $location = DB::table('store_location')->select('id', 'name')->get();
    return view('frontend.order.table', ['location' => $location]);
    }


}
