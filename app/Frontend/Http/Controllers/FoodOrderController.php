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
    public function getOrder()
    {
        return view("frontend.Food_Order.index");
    }
    public function FoodDetail()
    {
        return view("frontend.Food_Order.food-detail");
    }
    public function getLocations(Request $request)
    {   
        $storeId = $request->storeId;
        $location = DB::table('store_location')->join('store_store', 'store_location.store_id', '=', 'store_store.id')->where('store_store.id', $storeId)->select('store_location.id', 'store_location.name')->get();
    return view('frontend.foodorder.table', ['location' => $location]);
    }

    public function getDetail(Request $request)
    {   
        $id=$request->input('id');
        $detail = DB::table('store_entities')->where('id',$id)->get();
        $properties = DB::table('store_entities')
        ->join('store_entity_property_values', 'store_entity_property_values.entity_id', '=','store_entities.id')
        ->join('store_entity_properties', 'store_entity_properties.id', '=','store_entity_property_values.property_id')
        ->select('store_entities.id','store_entities.name','store_entities.price','store_entity_properties.property_label','store_entity_property_values.value')
        ->where('store_entities.id',$id)
        ->get();

        return view('frontend.foodorder.detail', ['detail'=>$detail,'properties'=>$properties] );
    }


}
