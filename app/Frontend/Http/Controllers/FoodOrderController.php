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

    public function getLocations(Request $request)
    {   
        $storeId = $request->storeId;
        $location = DB::table('store_location')->join('store_store', 'store_location.store_id', '=', 'store_store.id')->where('store_store.id', $storeId)->select('store_location.id', 'store_location.name')->get();
    return view('frontend.foodorder.table', ['location' => $location]);
    }

    public function getDetail(Request $request)
    {   $id=$request->input('id');
        $detail = DB::table('store_entities')->where('id',$id)->get();
        return view('frontend.foodorder.detail', ['detail'=>$detail]);
    }


}
