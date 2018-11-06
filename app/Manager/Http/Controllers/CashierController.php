<?php

namespace App\Manager\Http\Controllers;

use App\Core\Events\Customer2CashierPusher;
use App\Core\Events\PaymentDonePusher;
use App\Core\Events\RollbackCashierPusher;

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
		$beforeStatus = $request->beforeStatus;
		$res = DB::table('store_order')
		->where('store_order.store_id', $storeId)
		->whereIn('store_order.id', $listOrderId)
		->update(['store_order.status' => 4 ]);

		foreach ($listOrderId as $orderId) {
			$rollback = DB::table('store_rollback_cashier')->insert(
				[
					'store_id' => $storeId,
					'order_id' => $orderId,
					'before_status' => $beforeStatus
				]
			);
		}

		if ($res) event(new PaymentDonePusher($storeId, $listOrderId, $beforeStatus));
		return $res;
	}

	public function rollbackPayment(Request $request) {
		$storeId = $request->storeId;
		$orderId = $request->orderId;
		$status = $request->status;

		$res = DB::table('store_order')
		->where('store_id', $storeId)
		->where('id', $orderId)
		->update(['status' => $status ]);

		$res2 = DB::table('store_rollback_cashier')
		->where('store_id', $storeId)
		->where('order_id', $orderId)
		->delete();

		if ($res&&$res2) event(new RollbackCashierPusher($storeId));
		return $res;
	}
}