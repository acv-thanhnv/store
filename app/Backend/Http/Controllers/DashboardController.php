<?php

namespace App\Backend\Http\Controllers;
use App\Core\Helpers\AuthHelper;
use App\Core\Helpers\CommonHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Core\Dao\SDB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $storeId = CommonHelper::getStoreId();
        $order = SDB::select('SELECT count(datetime_order) as quantity FROM store.store_order where store_id = '.$storeId.' group by day(datetime_order)');
        return view('backend.dashboard.dashboard',['storeId'=>$storeId, 'order'=>$order]);
    }
    public function dashboardWaiter(){
        $storeId = CommonHelper::getStoreId();
        return view('backend.dashboard.dashboard_waiter',['storeId'=>$storeId]);
    }
    public function dashboardChef(){
        $storeId = CommonHelper::getStoreId();
        return view('backend.dashboard.dashboard_chef',['storeId'=>$storeId]);
    }
    public function dashboardClosedOrder(){
        $storeId = CommonHelper::getStoreId();
        return view('backend.dashboard.dashboard_closedorder',['storeId'=>$storeId]);
    }
    public function dashboardHistoryOrder(){
        $storeId = CommonHelper::getStoreId();
        return view('backend.dashboard.dashboard_historyorder',['storeId'=>$storeId]);
    }
}