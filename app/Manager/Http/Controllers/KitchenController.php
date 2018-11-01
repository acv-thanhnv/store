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
        //order-list
        $entity = DB::table('store_order')
        ->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
        ->join('store_entities', 'store_entities.id', '=','store_order_detail.entities_id')
        ->select('store_entities.name','store_order_detail.quantity','store_order_detail.cooked')
        ->where('store_order.store_id',$storeId)
        ->where('store_order.id',$orderId)
        ->get();

        $entity = DB::table('store_order')
        ->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
        ->join('store_entities', 'store_entities.id', '=','store_order_detail.entities_id')
        ->select('store_entities.name','store_order_detail.quantity','store_order_detail.cooked')
        ->where('store_order.store_id',$storeId)
        ->where('store_order.id',$orderId)
        ->get();

        $list = DB::table('store_order')
        ->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
        ->join('store_entities', 'store_entities.id', '=','store_order_detail.entities_id')
        ->select('store_entities.name','store_order.id','store_order.priority','store_order_detail.quantity','store_order_detail.cooked')
        ->where('store_order.store_id',$storeId)
        ->where('store_order.id',$orderId)
        ->get();

        //food-queue
        $queue = DB::table('store_order')
        ->join('store_order_status', 'store_order_status.id', '=','store_order.status')
        ->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
        ->join('store_entities', 'store_entities.id', '=','store_order_detail.entities_id')
        ->selectRaw('store_entities.name as name, sum(quantity) as quantity')
        ->where('store_order.store_id',$storeId)
        ->where('store_order.status',2)
        ->groupBy('entities_id')
        ->get();

        /*$data = [
            'list' => $list,
            'queue' => $queue
        ];
        $data = json_encode($data));*/
        event(new Order2ChefPusher(
            $storeId,
            $entity,
            $orderId,
            $locationId,
            $locationName,
            $description
        ));
        
    }

    public function index($storeId) {
        return view('frontend/chef3/index', ['storeId' => $storeId]);
    }

}