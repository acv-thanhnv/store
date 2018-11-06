<?php

namespace App\Api\V1\Http\Controllers;
use App\Api\V1\Services\Interfaces\FoodServiceInterface;
use App\Api\V1\Services\Interfaces\OrderServiceInterface;
use App\Core\Common\OrderStatusValue;
use App\Core\Common\SDBStatusCode;
use App\Core\Dao\SDB;
use App\Core\Entities\DataResultCollection;
use App\Core\Events\Order2ChefPusher;
use App\Core\Events\OrderPusherEvent;
use App\Core\Events\OrderStatusPusherEvent;
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

    public function Order2Chef(Request $request)
    {
        $Order = (object) $request->objOrder;
        $orderId  = $Order->orderId;
        $idTable  = $request->idTable;
        $arrOrder = SDB::table('store_order as order')
                    ->join('store_location as table','table.id','=','order.location_id')
                    ->join('store_floor as floor','floor.id','=','table.floor_id')
                    ->join('store_type_location as type','type.id','=','table.type_location_id')
                    ->where('order.id',$orderId)
                    ->select(
                        'order.access_token','order.store_id','order.datetime_order',
                        'order.datetime_update','order.location_id',
                        'table.name as table_name','floor.name as floor_name',
                        'table.type_location_id as priority','type.name as type_name'
                    )
                    ->get();
        $access_token = $arrOrder[0]->access_token;
        $idStore      = $arrOrder[0]->store_id;
        //update status of order
        SDB::table('store_order')
        ->where('id',$orderId)
        ->update(['status'=>2]);
        //update status of food
        foreach($Order->orderDetail as $key=>$obj){
            SDB::table('store_order_detail')
            ->where('id',$obj['order_detail_id'])
            ->update(['quantity' => $obj['order_detail_numProduct'],'status' => 2,'has_update' =>0]);
        }
        //get array of order
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
        //count order of table have status<2
        $numberOrderLowThan2 = SDB::table('store_order')
                                ->where('store_id',$idStore)
                                ->where('location_id',$idTable)
                                ->where('status','<','2')
                                ->select('id')
                                ->get();
        //call event get status 
        event(new OrderStatusPusherEvent($access_token,$orderId,$arrOrderDetail));
        //call event send to chef
        event(new Order2ChefPusher($idStore,$arrOrder,$arrOrderDetail));
        return count($numberOrderLowThan2);
    }

    public function deleteFoodOrderDetail(Request $request)
    {
        SDB::table('store_order_detail')
        ->where('id',$request->idOrderDetail)
        ->delete();
    }

    public function deleteOrder(Request $request)
    {
        SDB::table('store_order')
        ->where('id',$request->orderId)
        ->delete();

        SDB::table('store_order_detail')
        ->where('order_id',$request->orderId)
        ->delete();
    }
}
