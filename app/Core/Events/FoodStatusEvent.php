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
    public function __construct($access_token,$orderId=null,$location_id=null,$idDetail,$cooked,$foodStatus)
    {
        $this->access_token   = $access_token;
        $this->foodStatus     = $foodStatus;
        $this->idDetail       = $idDetail;
        $this->cooked         = $cooked;
        $this->orderId        = $orderId;
        $this->location_id    = $location_id;
        $this->foodStatusName = CommonHelper::getFoodStatusName($foodStatus);
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
        $channel_name = $this->access_token."_".FoodStatusValue::FoodStatusEvent;
        return new Channel($channel_name);
    }
}
