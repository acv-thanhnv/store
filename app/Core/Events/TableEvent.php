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
use Illuminate\Support\Facades\DB;

class TableEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $idStore;
    public $idTable;
    public $color;
    public function __construct($idStore,$idTable)
    {
        $NoDone  =0;
        $Done    =0;
        $Process =0;
        $this->idTable      = $idTable;
        $this->idStore     = $idStore;
        $arrTable = SDB::table('store_order')
                    ->where('location_id',$location_id)
                    ->where('store_id',$idStore)
                    ->select('id','status')
                    ->get();
        if(count($arrTable)==0){
        }
        foreach($arrTable as $obj){
            switch ($obj->status) {
                case FoodStatusValue::NoDone:
                    $NoDone++;
                    break;
                case FoodStatusValue::Process:
                    $Process++;
                    break;
                default:
                    $Done++;
                    break;
            }
        }
        if($NoDone>0){
            $color = FoodStatusValue::NoDone;
        }else if($){

        }
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