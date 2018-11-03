<?php

namespace App\Manager\Http\Controllers;

use App\Api\V1\Services\Interfaces\KitchenServiceInterface;
use App\Core\Events\Order2ChefPusher;

use Illuminate\Http\Request; 
use Pusher\Pusher;
use Illuminate\Support\Facades\DB;

class PusherController extends Controller
{
    private $kitchenService;

    public function __construct(KitchenServiceInterface $kitchenService)
    {
        $this->service = $kitchenService;
    }

    public function test(Request $request)
    {
        $storeId = $request->storeId;
        $orderId = $request->orderId;
        $locationByOrder = $this->service->getLocationByOrder($request);
        $entities = $this->service->getFoodByOrder($request);
        $priorityByOrder = $this->service->getPriorityByOrder($request);
        if (!($entities->isEmpty() || $locationByOrder->isEmpty() || $priorityByOrder->isEmpty())) {
            event(new Order2ChefPusher($storeId,$orderId,$priorityByOrder[0]->priority,$locationByOrder[0]->id,$locationByOrder[0]->name,$priorityByOrder[0]->description,$entities));
            return '1';}
            else return '0';
        }

        public function sendOrderToChef($orderId) {
        //order-list
            $list = DB::table('store_order')
            ->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
            ->join('store_entities', 'store_entities.id', '=','store_order_detail.entities_id')
            ->select('store_entities.name','store_order.id','store_order.priority','store_order_detail.quantity','store_order_detail.cooked')
            ->where('store_order.id',$orderId)
            ->get();

        //food-queue
            $queue = DB::table('store_order')
            ->join('store_order_status', 'store_order_status.id', '=','store_order.status')
            ->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
            ->join('store_entities', 'store_entities.id', '=','store_order_detail.entities_id')
            ->selectRaw('store_entities.name as name, sum(quantity) as quantity')
            ->where('store_order.status',2)
            ->groupBy('entities_id')
            ->get();

            $data = [
                'list' => $list,
                'queue' => $queue
            ];

            $pusher = $this->getPusher();
            $pusher->trigger('chef', 'newOrder', json_encode($data));
        }
    }