<?php

namespace App\Core\Events;

use App\Core\Common\OrderConst;
use App\Core\Helpers\CommonHelper;
use Illuminate\Broadcasting\Broadcasters\PusherBroadcaster;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\DB;

class Customer2OrderManagerPusher implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $result:

    public function __construct($storeId, $orderId)
    {
        $result = DB::table('store_order')
        ->join('store_order_detail', 'store_order_detail.order_id', '=','store_order.id')
        ->select('store_order_detail.id','store_order_detail.order_id','store_order_detail.entities_id','store_order_detail.quantity','store_order_detail.cooked','store_order_detail.status')
        ->where('store_order.store_id',$storeId)
        ->where('store_order_detail.order_id',$orderId)
        ->get();
        $this->result = $result;
    }

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function broadcastAs()
    {
        return OrderConst::UpdateOrderCooked;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel(CommonHelper::getOrderEventName($this->storeId,OrderConst::OrderChannelToWaiter));
    }
}