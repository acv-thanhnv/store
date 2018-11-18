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
use Illuminate\Support\Facades\Auth;

class OrderStatusPusherEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $arrOrder;
    public $order;
    public $has_rollBack;
    public $access_token;
    public $has_delete;
    public function __construct($access_token,$order,$arrOrder,$has_delete,$has_rollBack)
    {
        $this->has_rollBack = $has_rollBack;
        $this->arrOrder     = $arrOrder; //json array order status
        $this->order        = $order;
        $this->access_token = $access_token;
        $this->has_delete   = $has_delete;
    }
    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return OrderConst::OrderStatusEventName;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $channel_name = $this->access_token."_".OrderConst::OrderStatusEventName;
        return new Channel($channel_name);
    }
}
