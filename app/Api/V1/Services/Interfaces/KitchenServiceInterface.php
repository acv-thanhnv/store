<?php

namespace App\Api\V1\Services\Interfaces;

use Illuminate\Http\Request;

interface KitchenServiceInterface
{
	public function getFoodByOrderAll(Request $request);
	public function getPriorityByOrder(Request $request);
	public function getFoodByStore(Request $request);
    public function getFoodByOrder(Request $request);
    public function getOrderLocationByStore(Request $request);
    public function getOrderDetail(Request $request);
    public function getLocationByOrder(Request $request);
    public function getFoodQueue(Request $request);
}