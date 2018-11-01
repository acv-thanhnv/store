<?php

namespace App\Manager\Http\Controllers;

use App\Core\Events\Customer2CashierPusher;
use App\Core\Events\PaymentDonePusher;

use Illuminate\Http\Request; 
use Pusher\Pusher;
use Illuminate\Support\Facades\DB;

class CashierController extends Controller
{
    public function index($storeId) {
        return view('frontend/cashier3/index', ['storeId' => $storeId]);
    }

    public function test(Request $request) {
    	$storeId = $request->storeId;
    	$orderId = $request->orderId;
    	event(new Customer2CashierPusher(
            $storeId,
            $orderId
        ));
    }

    public function paymentDoneByOrder(Request $request) {
    	$storeId = $request->storeId;
        $listOrderId = $request->listOrderId;
        $res = DB::table('store_order')
        ->where('store_order.store_id', $storeId)
        ->whereIn('store_order.id', $listOrderId)
        ->update(['store_order.status' => 4 ]);

        if ($res) event(new PaymentDonePusher($storeId, $listOrderId));
        return $res;
    }
}