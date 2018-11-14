<?php

namespace App\Api\V1\Http\Controllers;
use App\Api\V1\Services\Interfaces\FoodServiceInterface;
use App\Api\V1\Services\Interfaces\OrderServiceInterface;
use App\Core\Common\FoodConst;
use App\Core\Common\FoodStatusValue;
use App\Core\Common\OrderStatusValue;
use App\Core\Common\SDBStatusCode;
use App\Core\Dao\SDB;
use App\Core\Entities\DataResultCollection;
use App\Core\Events\Order2ChefPusher;
use App\Core\Events\OrderPusherEvent;
use App\Core\Events\OrderStatusPusherEvent;
use App\Core\Events\Other2OrderManagerPusher;
use App\Core\Events\TableEvent;
use App\Core\Helpers\CommonHelper;
use App\Core\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    protected $service;
    protected $orderService;
    public function __construct(FoodServiceInterface $foodService, OrderServiceInterface $orderService)
    {
        $this->service = $foodService;
        $this->orderService = $orderService;
    }
//====================get location and floor===============
    public function getLocationFloor(Request $request){
        $storeId = $request->idStore;
        $list = $this->service->getLocationFloor($storeId);
        $result  = new DataResultCollection ();
        $result->status =  SDBStatusCode::OK;
        $result->data = $list;
        return view('frontend.order-manager.table_manager',['location'=>$result]);
    }

    public function listByStore($storeId = null){
        $list = $this->service->getFoodByStoreId($storeId);
        $result  = new DataResultCollection ();
        $result->status =  SDBStatusCode::OK;
        $result->data = $list;
        return ResponseHelper::JsonDataResult($result);
    }
    public function listByMenu(Request $request,$menuId=null){
        $storeId =   $request->input('idStore');
        $list = $this->service->getFoodByMenuId($menuId,$storeId);
        $result  = new DataResultCollection ();
        $result->status =  SDBStatusCode::OK;
        $result->data = $list;
        return ResponseHelper::JsonDataResult($result);
    }
    public function listMenu($storeId=null){
        $list = $this->service->getMenuList($storeId);
        $result  = new DataResultCollection ();
        $result->status =  SDBStatusCode::OK;
        $result->data = $list;
        return ResponseHelper::JsonDataResult($result);
    }

    public function listFloors(Request $request)
    {
        $idStore=$request->idStore;
        $list = $this->service->getFloorsByStore($idStore);
        $result = new DataResultCollection();
        $result->status = SDBStatusCode::OK;
        $result->data=$list;
        return ResponseHelper::JsonDataResult($result);
    }

    public function listTableByFloor(Request $request)
    {
        $idFloor = $request->idFloor;
        $idStore = $request->idStore;
        $list = $this->service->getLocationbyFloor($idFloor,$idStore);
        foreach($list as $obj){
            $obj->arrOrder = SDB::table('store_order as order')
                            ->where('order.location_id',$obj->id)
                            ->where('order.store_id',$idStore)
                            ->get();

        }
        $result = new DataResultCollection();
        $result->status = SDBStatusCode::OK;
        $result->data=$list;
        return ResponseHelper::JsonDataResult($result);
    }

    public function getLocation(Request $request){
        $idStore = $request->idStore;
        $idFloor = $request->idFloor;
        $list = $this->service->getLocation($idStore,$idFloor);
        foreach($list as $obj){
            $obj->arrOrder = SDB::table('store_order as order')
                            ->where('order.location_id',$obj->id)
                            ->where('order.store_id',$idStore)
                            ->orderby('order.id','asc')
                            ->get();

        }
        $result = new DataResultCollection();
        $result->status = SDBStatusCode::OK;
        $result->data=$list;
        return ResponseHelper::JsonDataResult($result);
    }

    public function getOrderByLocation(Request $request){
        $idLocation = $request->idLocation;
        $idStore = $request->idStore;
        $list = $this->service->getOrderByLocation($idLocation, $idStore);
        $result = new DataResultCollection();
        $result->status = SDBStatusCode::OK;
        $result->data=$list;
        return ResponseHelper::JsonDataResult($result);
    }

    public function search(Request $request)
    {
        $idStore        = $request->idStore;
        $key            = $request->key;
        $tab            = $request->tab;
        $result         = new DataResultCollection();
        $result->status = SDBStatusCode::OK;
        //nếu search table
        if($tab=='table'){
            $arrTable  = SDB::table('store_location as table')
                            ->join('store_floor as floor','floor.id','=','table.floor_id')
                            ->where('table.name','like','%'.$key.'%')
                            ->where('floor.store_id',$idStore)
                            ->select('table.*')
                            ->paginate(10);
            foreach($arrTable as $obj){
                $obj->arrOrder =   SDB::table('store_order as order')
                                        ->where('order.location_id',$obj->id)
                                        ->where('order.store_id',$idStore)
                                        ->orderby('order.id','asc')
                                        ->get();
            }
            $result->data = $arrTable;
            $result->tab  = 'table';
        }else{
            $result->data   = SDB::table('store_entities as food')
                            ->join('store_menu as menu','menu.id','=','food.menu_id')
                            ->where('food.name','like','%'.$key.'%')
                            ->where('menu.store_id',$idStore)
                            ->select('food.*')
                            ->paginate(FoodConst::foodPerPage);
            $result->tab  = 'menu';
        }
        return ResponseHelper::JsonDataResult($result);
    }

    public function newOrder(Request $request)
    {
        $Order["datetime_order"] = CommonHelper::dateNow();
        $Order["store_id"]       = $request->idStore;
        $Order["location_id"]    = $request->idTable;
        $Order["status"]         = OrderStatusValue::NoDone;
        $idOrder                 = SDB::table('store_order')->insertGetId($Order);
        $Order["id"]             = $idOrder;
        $Order["status_name"]    = CommonHelper::getOrderStatusName($Order["status"]);              
        return $Order;
    }

    public function Order2Chef(Request $request)
    {
        $Order = (object) $request->objOrder;
        $orderId  = $Order->orderId;
        $idTable  = $request->idTable;
        //update status of order
        SDB::table('store_order')
        ->where('id',$orderId)
        ->update(['status'=>OrderStatusValue::Process]);
        //update status of food
        foreach($Order->orderDetail as $key=>$obj){
            //nếu món ăn đấy đã được thêm ở phía của khách hàng thì cập nhập số lượng, ngược lại thì
            //tạo order detail cho order
            if($obj['order_detail_id']==null){
                SDB::table('store_order_detail')->insert([
                    'order_id'    =>$orderId,
                    'entities_id' =>$obj['entities_id'],
                    'quantity'    => $obj['order_detail_numProduct'],
                    'status'      => FoodStatusValue::Process,
                    'has_update'  => 0
                ]);
            }else {
                SDB::table('store_order_detail')
                ->where('id',$obj['order_detail_id'])
                ->update([
                    'quantity'   => $obj['order_detail_numProduct'],
                    'status'     => FoodStatusValue::Process,
                    'has_update' => 0
                ]);
            }
        }
        //get order info
        $arrOrder = SDB::table('store_order as order')
                    ->join('store_location as table','table.id','=','order.location_id')
                    ->join('store_floor as floor','floor.id','=','table.floor_id')
                    ->join('store_type_location as type','type.id','=','table.type_location_id')
                    ->join('store_order_status as status','status.value','=','order.status')
                    ->where('order.id',$orderId)
                    ->select(
                        'order.access_token','order.store_id','order.datetime_order','order.id',
                        'order.datetime_update','order.location_id','order.status','status.name as status_name',
                        'table.name as table_name','floor.name as floor_name',
                        'table.type_location_id as priority','type.name as type_name'
                    )
                    ->get();
        $access_token = $arrOrder[0]->access_token;
        $idStore      = $arrOrder[0]->store_id;
        //get array food detail of order
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
        //Đếm xem trong bàn đó có order nào chưa xác nhận ko
        $numberOrderTable = SDB::table('store_order')
                                ->where('store_id',$idStore)
                                ->where('location_id',$idTable)
                                ->where('status','<',OrderStatusValue::Process)
                                ->select('id')
                                ->get();
        //call event get status 
        event(new OrderStatusPusherEvent($access_token,$orderId,$arrOrderDetail));
        //call event send to chef
        event(new Order2ChefPusher($idStore,$arrOrder[0],$arrOrderDetail));
        //convert values into json
        $result              = new DataResultCollection();
        $result->status      = SDBStatusCode::OK;
        $result->data        = $arrOrderDetail;
        $result->order       = $arrOrder[0];
        $result->numberTable = count($numberOrderTable);
        return ResponseHelper::JsonDataResult($result);
    }

    public function deleteFoodOrderDetail(Request $request)
    {
        $orderId = $request->orderId;
        //delete food item
        SDB::table('store_order_detail')
        ->where('id',$request->idOrderDetail)
        ->delete();
        //get new list food items of order
        $arrOrderDetail = SDB::table('store_order_detail')
                            ->join('store_entities','store_order_detail.entities_id','=','store_entities.id')
                            ->join('store_order_detail_status','store_order_detail_status.value','=','store_order_detail.status')
                            ->select('store_order_detail.*','store_entities.name','store_entities.image','store_entities.price','store_order_detail_status.status_name')
                            ->where('order_id',$orderId)
                            ->get();
        $Process = 0;//variable count food was processed
        $NoDone  = 0;//variable count food not done
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
        $idStore        = $arrOrder[0]->store_id;
        $access_token   = $arrOrder[0]->access_token;
        $idTable        = $arrOrder[0]->location_id;
        //sau khi xóa gọi lại đúng hàm này đề build lại dữ liệu của order đó
        event(new Other2OrderManagerPusher($arrOrder[0]->store_id,$arrOrder[0],$arrOrderDetail));
        //call event bind table color
        event(new TableEvent($idStore,$idTable));
        //call event get status and return response for customer 
        event(new OrderStatusPusherEvent($access_token,$orderId,$arrOrderDetail));
    }

    public function deleteOrder(Request $request)
    {
        $arrOrder       = SDB::table('store_order')
                            ->where('id',$request->orderId)
                            ->select('access_token','store_id','location_id')
                            ->get();
        $access_token   = $arrOrder[0]->access_token;
        $idStore        = $arrOrder[0]->store_id;
        $idTable        = $arrOrder[0]->location_id;      
        ///delete order
        SDB::table('store_order')
        ->where('id',$request->orderId)
        ->delete();
        //delete order detail
        SDB::table('store_order_detail')
        ->where('order_id',$request->orderId)
        ->delete();
        //call event get status and return response for customer 
        event(new OrderStatusPusherEvent($access_token,$request->orderId,null,1));
        //call event bind table color
        event(new TableEvent($idStore,$idTable));
    }
}
