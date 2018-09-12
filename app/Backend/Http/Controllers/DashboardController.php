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
        return view('backend.dashboard.dashboard_waiter');
    }
    public function dashboardChef(){
        return view('backend.dashboard.dashboard_waiter');
    }
}
