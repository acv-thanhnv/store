<?php

namespace App\Core\Events;

use App\Core\Common\FoodStatusValue;
use App\Core\Common\OrderConst;
use App\Core\Helpers\CommonHelper;
use Illuminate\Broadcasting\Broadcasters\PusherBroadcaster;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class FoodStatusEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $access_token;
    public $idDetail;
    public $cooked;
    public $foodStatus;
    public $foodStatusName;
    public $orderId;
    public $location_id;
    public $idStore;
    public function __construct($access_token,$orderId,$idStore,$location_id,$idDetail,$cooked,$foodStatus)
    {
        $this->access_token   = $access_token;
        $this->foodStatus     = $foodStatus;
        $this->idDetail       = $idDetail;
        $this->cooked         = $cooked;
        $this->orderId        = $orderId;
        $this->location_id    = $location_id;
        $this->foodStatusName = CommonHelper::getFoodStatusName($foodStatus);
        $this->idStore        = $idStore;
    }
    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return FoodStatusValue::FoodStatusEvent;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $cus_channel_name = $this->access_token."_".FoodStatusValue::FoodStatusEvent;
        $order_channel_name = CommonHelper::getOrderEventName($this->idStore,FoodStatusValue::FoodStatusEvent);
        return [
            new Channel($cus_channel_name),
            new Channel($order_channel_name)
        ];
    }
}
