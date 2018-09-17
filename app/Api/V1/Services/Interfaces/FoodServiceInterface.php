<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 6/14/2018
 * Time: 10:23 AM
 */

namespace App\Api\V1\Services\Interfaces;

use Illuminate\Http\Request;

interface FoodServiceInterface
{
    public function getFoodByStoreId($storeId);

    public function getFoodByMenuId($menuId);

    public function getMenuList($storeId);

    public function orderToWaiter(Request $request);

    public function orderToChef(Request $request);

    public function closeOrder(Request $request);

    public function getOrderList( $storeId, $orderStatus,$orderDate,$page,$limitPage);
}
