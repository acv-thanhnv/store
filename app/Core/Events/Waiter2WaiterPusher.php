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

class Waiter2WaiterPusher implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $storeId;
    public $orderId;
    public $foodId;
    public $quantity;
    public $cooked;
    public $push;
    public $rollback;
    public $time;
    public function __construct($storeId, $orderId, $foodId, $quantity, $cooked, $push, $rollback, $time)
    {
        $this->storeId = $storeId;
        $this->orderId = $orderId;
        $this->foodId = $foodId;
        $this->quantity = $quantity;
        $this->cooked = $cooked;
        $this->push = $push;
        $this->rollback = $rollback;
        $this->time = $time;
    }

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function broadcastAs()
    {
        return OrderConst::UpdateOrderAtKitchenEvent;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel(CommonHelper::getOrderEventName($this->storeId,OrderConst::WaiterToWaiterChannel));
    }
}