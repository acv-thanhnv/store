<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 8/3/2018
 * Time: 10:44 AM
 */

namespace App\Api\V1\Services\Production;

use App\Api\V1\Services\Interfaces\OrderServiceInterface;
use App\Core\Common\OrderConst;
use App\Core\Common\OrderStatusValue;
use App\Core\Common\SDBStatusCode;
use App\Core\Dao\SDB;
use App\Core\Entities\DataResultCollection;
use App\Core\Events\OrderChefPusherEvent;
use App\Core\Events\OrderPusherEvent;
use App\Core\Helpers\CommonHelper;
use Illuminate\Http\Request;

class OrderService extends BaseService implements OrderServiceInterface
{
    public function orderToWaiter(Request $request)
    {
        $result = new DataResultCollection();
        //event to
        $response = $request->all();
        $storeId = isset($response['storeId']) ? $response['storeId'] : 0;
        $locationId = isset($response['locationId']) ? $response['locationId'] : 0;
        $locationName = isset($response['locationName']) ? $response['locationName'] : '';
        $totalPrice = isset($response['totalPrice']) ? $response['totalPrice'] : 0;
        $description = isset($response['description']) ? $response['description'] : '';
        $entity = json_decode($response['entity']);
        if (CommonHelper::existsStore($storeId)) {
            //insert into Database
            $dataOrder = array(
                "store_id" => $storeId,
                "location_id" => $locationId,
                "datetime_order" => now(),
                "status" => OrderStatusValue::Waiter,
                "priority" => 1,
                "description"=>$description
            );
            $now = now()->toDateTimeString();
            try {
                SDB::beginTransaction();
                $newOrderId = SDB::table('store_order')->insertGetId($dataOrder);
                $data = array();
                if (!empty($entity)) {
                    foreach ($entity as $key => $order) {
                        $data[] = array(
                            'order_id' => $newOrderId,
                            'entities_id' => isset($order->id) ? $order->id : 0,
                            'quantity' => isset($order->quantity) ? $order->quantity : 0
                        );
                    }
                }
                if (!empty($data)) {
                    SDB::table('store_order_detail')->insert($data);
                }
                $requestType = OrderConst::TypeAdd;
                event(new OrderPusherEvent($storeId, $newOrderId, $locationId,$locationName, $totalPrice,$description,$requestType,$now, $entity));
                SDB::commit();
                $result->status = SDBStatusCode::OK;
            } catch (\Exception $e) {
                SDB::rollBack();
                $result->status = SDBStatusCode::Excep;
                $result->message = $e->getMessage();
            }
        }else{
            $result->status = SDBStatusCode::Excep;
            $result->message = "Store not exists";
        }

        return $result;
    }
}
