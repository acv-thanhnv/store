<?php

namespace App\Api\V1\Services\Interfaces;

use Illuminate\Http\Request;

interface CashierServiceInterface
{
	public function getInvoicesByStore(Request $request);
	public function getInvoiceDetails3(Request $request);
    public function getInvoiceDetails(Request $request);
    public function getInvoicesByStore3(Request $request);
    public function getRollbackCashierTable(Request $request);
    public function getAllPayment(Request $request);
}