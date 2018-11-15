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

class Other2OrderManagerPusher implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $result;
    public $idStore;
    public $order;
    public function __construct($idStore,$order,$arrOrderDetail)
    {
        $this->result      = $arrOrderDetail;
        $this->idStore     = $idStore;
        $this->order       = $order;
    }

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function broadcastAs()
    {
        return OrderConst::Customer2Order;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel(CommonHelper::getOrderEventName($this->idStore,OrderConst::Customer2Order));
    }
}