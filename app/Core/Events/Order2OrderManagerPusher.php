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

class Order2OrderManagerPusher implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $storeId;
    public $orderId;
    public $locationId;
    public $locationName;
    /*public $totalPrice;
    public $dateTimeOrder;*/
    public $description;
    /*public $requestType;*/
    public $entity;
    public $priority;
    public function __construct($storeId,$orderId,$priority,$locationId,$locationName,$description,$entity)
    {
        $this->storeId = $storeId;
        $this->entity = $entity;
        $this->orderId = $orderId;
        $this->priority =  $priority;
        $this->locationId = $locationId;
        $this->locationName = $locationName;
        /*$this->totalPrice = $totalPrice;*/
        $this->description =  $description;
        /*$this->dateTimeOrder = $now;
        $this->requestType = $requestType;*/
    }
    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return OrderConst::OrderChefEventName;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel(CommonHelper::getOrderEventName($this->storeId,OrderConst::OrderChannelToChef));
    }
}