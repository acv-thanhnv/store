<?php

namespace App\Core\Events;

use App\Core\Common\FoodStatusValue;
use App\Core\Common\OrderConst;
use App\Core\Common\TableConst;
use App\Core\Dao\SDB;
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
        $NoDone  =0;//đếm order chờ xác nhận
        $Done    =0;//đếm order đang chờ biến hoặc hoàn thành
        $arrTable = SDB::table('store_order')
                    ->where('location_id',$idTable)
                    ->where('store_id',$idStore)
                    ->select('id','status')
                    ->get();
        //nếu bàn đó ko còn order nào thì hiện bàn trống
        if(count($arrTable)==0){
            $color = TableConst::noOrder;
        }else{
            foreach($arrTable as $obj){
                switch ($obj->status) {
                    case FoodStatusValue::NoDone:
                        $NoDone++;
                        break;
                    default:
                        $Done++;
                        break;
                }
            }
            //nếu cớ order chờ thì bàn màu..., ngược lại đang chế biến hoặc chế biến xong thì màu...
            if($NoDone>0){
                $color = TableConst::haveOrder;
            }else{
                $color = TableConst::Done;
            }
        }
        $this->idTable      = $idTable;
        $this->idStore     = $idStore;
        $this->color   = $color;
    }

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function broadcastAs()
    {
        return TableConst::TableColorEvent;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel(CommonHelper::getOrderEventName($this->idStore,TableConst::TableColorEvent));
    }
}