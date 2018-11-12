<?php

namespace App\Manager\Http\Controllers;

use App\Core\Events\Order2ChefPusher;
use App\Core\Events\Waiter2WaiterPusher;

use Illuminate\Http\Request; 
use Pusher\Pusher;
use Illuminate\Support\Facades\DB;

class KitchenController extends Controller
{
    public function rollbackFoodByOrder(Request $request) {
        $storeId = $request->storeId;
        $orderId = $request->orderId;
        $foodId = $request->foodId;
        $push = $request->push;
        $time = $request->time;

        $res2 = DB::table('store_rollback_kitchen')
        ->where('store_id', $storeId)
        ->where('order_id', $orderId)
        ->where('food_id', $foodId)
        ->where('time', $time)
        ->delete();

        $quantityCooked = DB::table('store_order')
        ->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
        ->select('store_order_detail.quantity','store_order_detail.cooked')
        ->where('store_order.store_id',$storeId)
        ->where('store_order_detail.order_id', $orderId)
        ->where('store_order_detail.entities_id', $foodId)
        ->get();

        $quantity = $quantityCooked[0]->quantity;

        $cooked = $quantityCooked[0]->cooked;

        $cooked = $cooked - $push;

        if ($cooked<0) $cooked=0;

        $res = DB::table('store_order')
        ->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
        ->where('store_order_detail.order_id', $orderId)
        ->where('store_order_detail.entities_id', $foodId)
        ->update(['store_order_detail.cooked' => $cooked ]);

        event(new Waiter2WaiterPusher($storeId, $orderId, $foodId, $quantity, $cooked, 0, 1, $time));
        return $res;
    }

    public function updateFoodByOrder(Request $request) {
        $storeId = $request->storeId;
        $orderId = $request->orderId;
        $foodId = $request->foodId;
        $cooked = $request->cooked;
        $time = $request->time;

        $rollback = DB::table('store_rollback_kitchen')->insert(
            [
                'store_id' => $storeId,
                'order_id' => $orderId,
                'food_id' => $foodId,
                'cooked' => $cooked,
                'time' => $time
            ]
        );

        $quantity = DB::table('store_order')
        ->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
        ->where('store_order.store_id',$storeId)
        ->where('store_order_detail.order_id', $orderId)
        ->where('store_order_detail.entities_id', $foodId)
        ->value('store_order_detail.quantity');

        $isAllDone = DB::table('store_order_detail')
        ->where('order_id', $orderId)
        ->whereRaw('store_order_detail.quantity != store_order_detail.cooked')
        ->get();
        if ( count($isAllDone)==1 && ($cooked==$quantity) ) {
            $clearAll=1;
            /*$statusTo3 = DB::table('store_order')
            ->where('order_id', $orderId)
            ->update(['status' => 3]);*/
        }
        else $clearAll = 0;

        $res = DB::table('store_order_detail')
        ->where('order_id', $orderId)
        ->where('entities_id', $foodId)
        ->update(['cooked' => $cooked]);

        if ($res) event(new Waiter2WaiterPusher($storeId, $orderId, $foodId, $quantity, $cooked, $clearAll, 0, 0));
        return $res;
    }

    public function newOrder2Kitchen($storeId, $orderId)
    {

        $orderDetails = DB::table('store_order')
        ->join('store_location', 'store_order.location_id', '=','store_location.id')
        ->join('store_floor', 'store_location.floor_id', '=','store_floor.id')
        ->join('store_type_location', 'store_location.type_location_id', '=','store_type_location.id')
        ->select('store_order.id as order_id', 'store_location.name as table', 'store_floor.name as floor', 'store_type_location.name as priority')
        ->where('store_order.store_id',$storeId)
        ->where('store_order.id',$orderId)
        ->get();

        $foodDetails = DB::table('store_order')
        ->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
        ->join('store_entities', 'store_entities.id', '=','store_order_detail.entities_id')
        ->select('store_entities.id as food_id','store_entities.name as food_name','store_order_detail.quantity')
        ->where('store_order.store_id',$storeId)
        ->where('store_order.id',$orderId)
        ->get();
        
        event(new Order2ChefPusher(
            1,
            $orderDetails,
            $foodDetails
        ));
    }

    public function pushFoodToCustomer()
    {
        $storeId = 2;
        $access_token = "49f1b73ae346a219e8e6a5670b6c3ba3";
        $orderDetails = DB::table('store_order')
        ->join('store_location', 'store_order.location_id', '=','store_location.id')
        ->join('store_floor', 'store_location.floor_id', '=','store_floor.id')
        ->join('store_type_location', 'store_location.type_location_id', '=','store_type_location.id')
        ->select('store_order.access_token', 'store_order.store_id', 'store_order.datetime_order', 'store_order.datetime_update', 'store_order.location_id', 'store_location.name as table_name', 'store_floor.name as floor_name', 'store_order.priority', 'store_type_location.name as type_name')
        ->where('store_order.store_id',$storeId)
        ->where('store_order.access_token',$access_token)
        ->get();

        $foodDetails = DB::table('store_order')
        ->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
        ->join('store_entities', 'store_entities.id', '=','store_order_detail.entities_id')
        ->join('store_order_detail_status', 'store_order_detail.status', '=','store_order_detail_status.value')
        ->select('store_order_detail.id','store_order.id as order_id','store_order_detail.entities_id', 'store_order_detail.quantity', 'store_order_detail.cooked', 'store_order_detail.status', 'store_order_detail.has_update', 'store_entities.name', 'store_entities.image', 'store_entities.price', 'store_order_detail_status.status_name')
        ->where('store_order.store_id',$storeId)
        ->where('store_order.access_token',$access_token)
        ->get();
        
        return response()->json($foodDetails); 
    }

    public function index($storeId) {
        return view('frontend/chef3/index', ['storeId' => $storeId]);
    }

}