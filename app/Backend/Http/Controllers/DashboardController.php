<?php

namespace App\Backend\Http\Controllers;
use Illuminate\Http\Request;

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
        return view('home');
    }
    public function dashboardWaiter(){
        $storeId = 1;
        return view('backend.dashboard.dashboard_waiter',['storeId'=>$storeId]);
    }
    public function dashboardChef(){
        $storeId = 2;
        return view('backend.dashboard.dashboard_chef',['storeId'=>$storeId]);
    }
}
