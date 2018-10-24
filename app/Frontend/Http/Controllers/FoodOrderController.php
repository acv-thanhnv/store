<?php

namespace App\Frontend\Http\Controllers;
use App\Backend\Services\Interfaces\FoodServiceInterface;
use App\Backend\Services\Interfaces\MenuServiceInterface;
use App\Core\Common\FoodConst;
use App\Core\Common\SDBStatusCode;
use App\Core\Dao\SDB;
use App\Core\Entities\DataResultCollection;
use App\Core\Helpers\CommonHelper;
use App\Core\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class FoodOrderController extends Controller
{   

    protected $foodService;
    protected $menuService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    public function __construct(FoodServiceInterface $foodService, MenuServiceInterface $menuService)
    {
        $this->foodService = $foodService;
        $this->menuService = $menuService;
    }

    public function getOrder(Request $request)
    {  
        $idStore  = $request->idStore;
        $arrTable = SDB::table('store_location')
                    ->where("store_id",$idStore)
                    ->get();
        return view('frontend.foodorder.index',[
            "idStore"  => $idStore,
            "arrTable" => $arrTable
        ]);
    }
    public function getMenu(Request $request)
    {
        $result         = new DataResultCollection();
        $idStore        = $request->idStore;
        $arrMenu        = $this->menuService->getMenu($idStore);
        $result->status = SDBStatusCode::OK;    
        $result->data   = $arrMenu;               
        return ResponseHelper::JsonDataResult($result);
    }
    public function getFood(Request $request)
    {
        $idStore = $request->idStore;
        $total   = FoodConst::foodPerPage;
        $arrFood = $this->foodService->getFood($idStore,$total);
        foreach($arrFood as $obj){
            //check avatar
            if($obj->image==NULL){
                $obj->src = url('/')."/common_images/no-store.png";
            }else{
                $obj->src = CommonHelper::getImageUrl($obj->image);
            }
        }
        $result         = new DataResultCollection();
        $result->status = SDBStatusCode::OK;
        $result->data   = $arrFood;
        return ResponseHelper::JsonDataResult($result);
    }
    public function getFoodByMenu(Request $request)
    {
        # code...
    }
    public function sendOrder(Request $request)
    {
        dd($request->cart_items);
    }
    public function FoodDetail()
    {
        return view("frontend.Food_Order.food-detail");
    }
    public function getLocations(Request $request)
    {   
        $storeId  = $request->storeId;
        $location = DB::table('store_location')->join('store_store', 'store_location.store_id', '=', 'store_store.id')->where('store_store.id', $storeId)->select('store_location.id', 'store_location.name')->get();
    return view('frontend.foodorder.table', ['location' => $location]);
    }

    public function getDetail(Request $request)
    {   
        $id         =$request->input('id');
        $detail     = DB::table('store_entities')->where('id',$id)->get();
        $properties = DB::table('store_entities')
        ->join('store_entity_property_values', 'store_entity_property_values.entity_id', '=','store_entities.id')
        ->join('store_entity_properties', 'store_entity_properties.id', '=','store_entity_property_values.property_id')
        ->select('store_entities.id','store_entities.name','store_entities.price','store_entity_properties.property_label','store_entity_property_values.value')
        ->where('store_entities.id',$id)
        ->get();

        return view('frontend.foodorder.detail', ['detail'=>$detail,'properties'=>$properties] );
    }


}
