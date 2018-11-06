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

        $res = DB::table('store_order')
        ->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
        ->where('store_order_detail.order_id', $orderId)
        ->where('store_order_detail.entities_id', $foodId)
        ->update(['store_order_detail.cooked' => $cooked ]);

        if ($res) event(new Waiter2WaiterPusher($storeId, $orderId, $foodId, $quantity, $cooked, 2));
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
        if ( count($isAllDone)==1 && ($cooked==$quantity) ) $clear=1;
        else $clear = 0;

        $res = DB::table('store_order_detail')
        ->where('order_id', $orderId)
        ->where('entities_id', $foodId)
        ->update(['cooked' => $cooked]);

        if ($res) event(new Waiter2WaiterPusher($storeId, $orderId, $foodId, $quantity, $cooked, $clear));
        return $res;
    }

    public function newOrder2Kitchen($storeId, $orderId)
    {

        $orderDetails = DB::table('store_order')
        ->join('store_location', 'store_order.location_id', '=','store_location.id')
        ->join('store_floor', 'store_location.floor_id', '=','store_floor.id')
        ->select('store_order.id as order_id', 'store_location.name as table', 'store_floor.name as floor', 'store_order.priority', 'store_order.datetime_order')
        ->where('store_order.store_id',$storeId)
        ->where('store_order.id',$orderId)
        ->whereIn('store_order.status',[1,2])
        ->orderBy('store_order.datetime_order', 'asc')
        ->orderBy('store_order.datetime_update', 'asc')
        ->orderBy('store_order.priority', 'desc')
        ->get();

        $foodDetails = DB::table('store_order')
        ->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
        ->join('store_entities', 'store_entities.id', '=','store_order_detail.entities_id')
        ->select('store_entities.id as food_id','store_entities.name as food_name','store_order_detail.quantity')
        ->where('store_order.store_id',$storeId)
        ->where('store_order.id',$orderId)
        ->whereIn('store_order.status',[1,2])
        ->whereRaw('store_order_detail.quantity > store_order_detail.cooked')
        ->get();
        
        event(new Order2ChefPusher(
            1,
            $orderDetails,
            $foodDetails
        ));
    }

    public function index($storeId) {
        return view('frontend/chef3/index', ['storeId' => $storeId]);
    }

}