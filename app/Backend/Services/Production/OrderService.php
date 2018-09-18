<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 8/3/2018
 * Time: 10:44 AM
 */

namespace App\Backend\Services\Production;

use App\Backend\Services\Interfaces\OrderServiceInterface;
use App\Core\Dao\SDB;
use Illuminate\Support\Facades\Storage;
class OrderService extends BaseService implements OrderServiceInterface
{
    public function countOrderHistory($idStore){
        $totalRecord = SDB::table('store_order')
            ->where('store_order.store_id','=',$idStore)
            ->count();
        return $totalRecord;
    }
}
