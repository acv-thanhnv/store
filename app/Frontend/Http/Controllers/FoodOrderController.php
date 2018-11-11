<?php

namespace App\Frontend\Http\Controllers;
use App\Backend\Services\Interfaces\FoodServiceInterface;
use App\Backend\Services\Interfaces\MenuServiceInterface;
use App\Core\Common\FoodConst;
use App\Core\Common\FoodStatusValue;
use App\Core\Common\OrderStatusValue;
use App\Core\Common\SDBStatusCode;
use App\Core\Dao\SDB;
use App\Core\Entities\DataResultCollection;
use App\Core\Events\Customer2OrderManagerPusher;
use App\Core\Events\OrderPusherEvent;
use App\Core\Events\OrderStatusPusherEvent;
use App\Core\Events\TableEvent;
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
                        ->join('store_floor', 'store_location.floor_id','=', 'store_floor.id')
                        ->where('store_floor.store_id', $idStore)
                        ->select('store_location.*')
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
        $idStore                  = $request->idStore;
        $orderId                  = $request->orderId;
        $ip                       = $request->ip();
        $order["access_token"]    = $request->access_token;
        $order["store_id"]        = $request->idStore;
        $order["location_id"]     = $request->table;
        $cart_items               = $request->cart_items;
        $order["description"]     = $request->description;
        $order["status"]          = 0;
        $order["datetime_order"]  = CommonHelper::dateNow();  
        if($orderId===null){
            //create new order
            $orderId                  = SDB::table('store_order')
                                            ->insertGetId($order);
            $order_detail['order_id'] = $orderId;
            $order['id']              = $orderId;
            $order['id']              = $orderId;
            $order['status_name']     = CommonHelper::getOrderStatusName($order['status']);
        } else {
            $order_detail['order_id'] = $orderId;
            $order['id']              = $orderId;
            //get status of order
            $order_status = SDB::table('store_order')
                            ->where('id',$orderId)
                            ->select('status')
                            ->get();
            //nếu order đã nấu xong thì khi thêm món mới cập nhập time update của order
            if($order_status[0]->status==OrderStatusValue::Done){
                $datetime_update = CommonHelper::dateNow();
                SDB::table('store_order')
                ->where('id',$orderId)
                ->update(['datetime_update' => $datetime_update]);
                //set time update for order
                $order['datetime_update'] = $datetime_update;
            }
            //nếu order đang chế biến thì chuyển status về chưa xác nhận
            if ($order_status[0]->status>=OrderStatusValue::Process) {
                //Cập nhập status của order
                SDB::table('store_order')
                        ->where('id',$orderId)
                        ->update(['status' => OrderStatusValue::NoDone]);
                $order["status"]      = OrderStatusValue::NoDone;
                $order['status_name'] = CommonHelper::getOrderStatusName($order['status']);
            }
        }
        foreach($cart_items as $key=>$obj){
            $order_detail['entities_id']     = $obj['entities_id'];
            $order_detail['quantity']        = $obj['quantity'];
            $order_detail['status']          = FoodStatusValue::NoDone;
            $order_detail['has_update']      = 1;
            $cart_items[$key]['status_name'] = CommonHelper::getFoodStatusName(1);
            $cart_items[$key]['status']      = FoodStatusValue::NoDone;
            //nếu món ăn đó đã được order rồi thì cập nhập số lượng cũng như tình trạng món
            if(isset($obj["id"])){
                //nếu món đó đã tồn tại và đang chế biến hoặc hoàn thành
                SDB::table('store_order_detail')
                ->where('id',$obj['id'])
                ->where('status','>=',FoodStatusValue::Process)
                ->update([
                    'quantity'   => $obj['quantity'],
                    'status'     => FoodStatusValue::NoDone,
                    'has_update' => 1
                ]);
                //set update for item
                $cart_items[$key]['has_update'] = 1;
            }else{
                //ngược lại thì insert mới 
                SDB::table('store_order_detail')->insert($order_detail);
            }
        }
        $arrOrderDetail = SDB::table('store_order_detail')
                    ->join('store_entities','store_order_detail.entities_id','=','store_entities.id')
                    ->join('store_order_detail_status','store_order_detail_status.value','=','store_order_detail.status')
                    ->select('store_order_detail.*','store_entities.name','store_entities.image','store_entities.price','store_order_detail_status.status_name')
                    ->where('order_id',$orderId)
                    ->get();
        foreach($arrOrderDetail as $obj){
            if($obj->image==NULL){
                $obj->src = url('/')."/common_images/no-store.png";
            }else{
                $obj->src = CommonHelper::getImageUrl($obj->image);
            }
        }
        //call event send to Order
        event(new Customer2OrderManagerPusher($idStore,$order,$arrOrderDetail));
        //call pusher when order, status food change
        event(new OrderStatusPusherEvent($request->access_token,$orderId,$arrOrderDetail));
        //call event bind table color
        event(new TableEvent($idStore,$request->table));
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
        $idFood  = $request->id;
        $orderId = $request->orderId;
        //delete food item
        SDB::table('store_order_detail')
        ->where('id',$idFood)
        ->delete();
        //get food items
        $arrOrderDetail = SDB::table('store_order_detail')
                    ->join('store_entities','store_order_detail.entities_id','=','store_entities.id')
                    ->join('store_order_detail_status','store_order_detail_status.value','=','store_order_detail.status')
                    ->select('store_order_detail.*','store_entities.name','store_entities.image','store_entities.price','store_order_detail_status.status_name')
                    ->where('order_id',$orderId)
                    ->get();
        $Process = 0;//variable count food was processed
        $NoDone  = 0;//variable count food not done
        //nếu người dùng xóa món,order trống thì tình trạng là chưa xác nhận
        if(count($arrOrderDetail)==0){
            $NoDone++;
        }else{
            foreach($arrOrderDetail as $obj){
                //check status of food, nếu ko có món nào là đang chờ xác nhận thì status của order chuyển theo món
                switch ($obj->status) {
                    case FoodStatusValue::Process:
                        $Process ++;
                        break;
                    default:
                        $NoDone++;
                }
                if($obj->image==NULL){
                    $obj->src = url('/')."/common_images/no-store.png";
                }else{
                    $obj->src = CommonHelper::getImageUrl($obj->image);
                }
            }
        }
        if($NoDone>0){//nếu order đó có món ăn chưa xác nhận thì order status là chưa xác nhận
            SDB::table('store_order')->where('id',$orderId)->update(['status'=>OrderStatusValue::NoDone]);
        }else if($Process>0){// ng lại, nếu có món đang chế biến thì status là đang chế biến
            SDB::table('store_order')->where('id',$orderId)->update(['status'=>OrderStatusValue::Process]);
        }else{//còn lại là xong rồi
            SDB::table('store_order')->where('id',$orderId)->update(['status'=>OrderStatusValue::Done]);
        }
        //get access token and orderId
        $arrOrder       = SDB::table('store_order as order')
                        ->join('store_order_status as status','status.value','=','order.status')
                        ->where('order.id',$orderId)
                        ->select('order.*','status.name as status_name')
                        ->get();
        $idStore = $arrOrder[0]->store_id;
        //call event send to Order
        event(new Customer2OrderManagerPusher($idStore,$arrOrder[0],$arrOrderDetail));
        //call event bind table color
        event(new TableEvent($idStore,$arrOrder[0]->location_id));
    }
}
