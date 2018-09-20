<?php

namespace App\Frontend\Http\Controllers;
use App\Api\V1\Services\Production\FoodService;
use App\Core\Dao\SDB;
use App\Core\Helpers\CommonHelper;
use App\Core\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
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
        return view('frontend.home');
    }
    public function apilogin(){
        return view('frontend.api_login');
    }
    public function test(Request $request)
    {
        return view('frontend.testorder');
    }
    public function Map()
    {
        $arrCoor = SDB::table("store_store")->get();
        foreach ($arrCoor as $obj) {
            if($obj->avatar==NULL){
                 $obj->src = url('/')."/common_images/no-store.png";
            }else{
                $obj->src = CommonHelper::getImageUrl($obj->avatar);
            }
        }
        $arrCoor = json_encode($arrCoor);
        return view("frontend.mapApi",["arrCoor" => $arrCoor]); 
    }
}
