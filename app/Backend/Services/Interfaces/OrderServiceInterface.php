<?php
/**
 * Created by Gemkids.
 * User: MSI
 * Date: 09/06/2018
 * Time: 15:36 PM
 */
namespace App\Backend\Services\Interfaces;


use Illuminate\Http\Request;

interface OrderServiceInterface
{
    public function orderToWaiter(Request $request);

    public function orderToChef(Request $request);

    public function closeOrder(Request $request);

    public function getOrderList( $storeId, $orderStatus,$orderDate,$page,$limitPage);

    public function deleteOrder(Request $request,$userStoreId, $orderStatus);
}
