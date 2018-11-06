<?php

namespace App\Frontend\Http\Controllers;
use App\Backend\Services\Interfaces\FoodServiceInterface;
use App\Backend\Services\Interfaces\MenuServiceInterface;
use App\Core\Common\FoodConst;
use App\Core\Common\SDBStatusCode;
use App\Core\Dao\SDB;
use App\Core\Entities\DataResultCollection;
use App\Core\Events\OrderPusherEvent;
use App\Core\Events\OrderStatusPusherEvent;
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
        $idStore      = $request->idStore;
        $arrTable     = SDB::table('store_location')
        ->where("store_id",$idStore)
        ->get();
        $access_token = md5(CommonHelper::dateNow());
        return view('frontend.foodorder.index',[
            "idStore"      => $idStore,
            "arrTable"     => $arrTable,
            'access_token' => $access_token
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
        $key = $request->key;
        if($key==null){
            $key = '';
        }
        $menu_id = $request->menu_id;
        $total   = FoodConst::foodPerPage;
        if($menu_id ==null){
            $arrFood = SDB::table('store_entities')
                        ->join('store_menu','store_menu.id','=','store_entities.menu_id')
                        ->where('store_menu.store_id',$idStore)
                        ->where('store_entities.name','like','%'.$key.'%')
                        ->select('store_entities.*')
                        ->orderby('store_entities.id','desc')
                        ->paginate($total);
        }else{
            $arrFood = SDB::table('store_entities')
                        ->where('menu_id',$menu_id)
                        ->paginate($total);
        }
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
    public function OrderBy(Request $request)
    {
        $idStore = $request->idStore;
        $price   = $request->price;
        $sortBy  = $request->sortBy;
        $orderKey;
        $value;
        $total   = FoodConst::foodPerPage;
        switch ($sortBy) {
            case 'name':
                $orderKey = 'store_entities.'.$sortBy;
                $value    = "asc";
                break;
            case 'lth':
                $orderKey = 'store_entities.price';
                $value    = "asc";
                break;
            case 'htl':
                $orderKey = 'store_entities.price';
                $value    = "desc";
                break;
            case 'other':
                switch ($price) {
                    case 'l50':
                        $arrFood = SDB::table('store_entities')
                                    ->join('store_menu','store_menu.id','=','store_entities.menu_id')
                                    ->where('store_menu.store_id',$idStore)
                                    ->where('store_entities.price','<=',50000)
                                    ->select('store_entities.*')
                                    ->orderby('store_entities.price','asc')
                                    ->paginate($total);
                        break;
                    case '50-100' :
                        $arrFood = SDB::table('store_entities')
                                    ->join('store_menu','store_menu.id','=','store_entities.menu_id')
                                    ->where('store_menu.store_id',$idStore)
                                    ->whereBetween('store_entities.price',[50000,100000])
                                    ->select('store_entities.*')
                                    ->orderby('store_entities.price','asc')
                                    ->paginate($total);
                        break;
                    case '100-300' :                        $arrFood = SDB::table('store_entities')
                                    ->join('store_menu','store_menu.id','=','store_entities.menu_id')
                                    ->where('store_menu.store_id',$idStore)
                                    ->whereBetween('store_entities.price',[101000,300000])
                                    ->select('store_entities.*')
                                    ->orderby('store_entities.price','asc')
                                    ->paginate($total);
                        break;
                    case '300h' :
                        $arrFood = SDB::table('store_entities')
                                    ->join('store_menu','store_menu.id','=','store_entities.menu_id')
                                    ->where('store_menu.store_id',$idStore)
                                    ->where('store_entities.price','>',300000)
                                    ->select('store_entities.*')
                                    ->orderby('store_entities.price','asc')
                                    ->paginate($total);
                        break;
                    default:
                        $price='1';
                        $arrFood = SDB::table('store_entities')
                                    ->join('store_menu','store_menu.id','=','store_entities.menu_id')
                                    ->where('store_menu.store_id',$idStore)
                                    ->select('store_entities.*')
                                    ->orderby('store_entities.price','asc')
                                    ->paginate($total);
                        break;
                }
                $orderKey = 'store_entities.price';
                $value    = "desc";
                break;
            default:
                $orderKey = 'store_entities.id';
                $value = "desc";
                break;
        }
        if($price==null){
            $arrFood = SDB::table('store_entities')
                    ->join('store_menu','store_menu.id','=','store_entities.menu_id')
                    ->where('store_menu.store_id',$idStore)
                    ->select('store_entities.*')
                    ->orderby($orderKey,$value)
                    ->paginate($total);
        }
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
    public function sendOrder(Request $request)
    {
        $orderId                  = $request->orderId;
        $ip                       = $request->ip();
        $access_token             = $request->access_token;
        $order["access_token"]    = $request->access_token;
        $order["store_id"]        = $request->idStore;
        $order["location_id"]     = $request->table;
        $cart_items               = $request->cart_items;
        $order["description"]     = $request->description;
        $order["datetime_order"]  = CommonHelper::dateNow();
        $order["datetime_update"] = CommonHelper::dateNow();
        if($orderId===null){
            //create new order
            $orderId                  = SDB::table('store_order')
                                            ->insertGetId($order);
            $order_detail['order_id'] = $orderId;
        } else {
            $order_detail['order_id'] = $orderId;
            //get status of order
            $order_status = SDB::table('store_order')
                            ->where('id',$orderId)
                            ->select('status')
                            ->get();
            if($order_status[0]->status===3){//check if food have been cooked, update time 
                $datetime_update = CommonHelper::dateNow();
                SDB::table('store_order')
                ->where('id',$orderId)
                ->update(['datetime_update' => $datetime_update]);
            }
        }
        foreach($cart_items as $obj){
            $order_detail['entities_id'] = $obj['entities_id'];
            $order_detail['quantity']    = $obj['quantity'];
            $order_detail['status']      = 1;
            if(isset($obj["id"])){
                SDB::table('store_order_detail')
                ->where('id',$obj['id'])
                ->update(['quantity' => $obj['quantity'],'status' => 1]);
            }else{
                SDB::table('store_order_detail')->insert($order_detail);
            }
        }
        $arrOrder = SDB::table('store_order_detail')
                    ->join('store_entities','store_order_detail.entities_id','=','store_entities.id')
                    ->join('store_order_detail_status','store_order_detail_status.value','=','store_order_detail.status')
                    ->select('store_order_detail.*','store_entities.name','store_entities.image','store_entities.price','store_order_detail_status.status_name')
                    ->where('order_id',$orderId)
                    ->get();
        foreach($arrOrder as $obj){
            if($obj->image==NULL){
                $obj->src = url('/')."/common_images/no-store.png";
            }else{
                $obj->src = CommonHelper::getImageUrl($obj->image);
            }
        }
        //
        //call pusher when order, status food change
        event(new OrderStatusPusherEvent($access_token,$orderId,$arrOrder));
        return $orderId;
    }
    public function FoodDetail(Request $request)
    {
        $entities_id = $request->entities_id;
        $foodDetail = SDB::table('store_entities')
            ->where('id',$entities_id)
            ->get();
        foreach($foodDetail as $obj){
            //check avatar
            if($obj->image==NULL){
                $obj->src = url('/')."/common_images/no-store.png";
            }else{
                $obj->src = CommonHelper::getImageUrl($obj->image);
            }
        }
        return view("frontend.FoodOrder.food-detail",["foodDetail" => $foodDetail[0]]);
    }
    public function deleteCartItem(Request $request)
    {
        $id = $request->id;
        SDB::table('store_order_detail')
        ->where('id',$id)
        ->delete();
    }
}
