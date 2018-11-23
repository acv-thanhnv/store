<?php

namespace App\Api\V1\Http\Controllers;
use App\Api\V1\Services\Interfaces\CashierServiceInterface;
use App\Core\Common\OrderConst;
use App\Core\Common\OrderStatusValue;
use App\Core\Common\SDBStatusCode;
use App\Core\Entities\DataResultCollection;
use App\Core\Events\OrderPusherEvent;
use App\Core\Helpers\CommonHelper;
use App\Core\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class CashierController extends Controller
{
	protected $CashierService;
    public function __construct(CashierServiceInterface $CashierService)
    {
        $this->service = $CashierService;
    }

    public function showAllPayment(Request $request) {
    	$data = $this->service->getAllPayment($request);
    	return response()->json($data);
    }

    public function showInvoicesByStore(Request $request) {
		$data = $this->service->getInvoicesByStore($request);
		$details = $this->service->getInvoiceDetails($request);
		$arr = [
			'storeId' => $request->storeId,
			'orders' => $data,
			'details' => $details
		];
		return response()->json($arr);
	}

	public function showInvoicesPushedByCustomer(Request $request) {
		$data = $this->service->getInvoicesByStore3($request);
		$details = $this->service->getInvoiceDetails3($request);
		$arr = [
			'storeId' => $request->storeId,
			'orders' => $data,
			'details' => $details
		];
		return response()->json($arr);
	}

	public function showRollbackCashierTable(Request $request) {
		$data = $this->service->getRollbackCashierTable($request);
		return response()->json($data);
	}

	public function showListRequestsToCashierTable(Request $request) {
		$data = $this->service->getListRequestsToCashier($request);
		return response()->json($data);
	}

}
