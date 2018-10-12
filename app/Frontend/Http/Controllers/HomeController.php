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
        $map = SDB::table("store_store")->get();
        foreach ($map as $obj) {
            if($obj->avatar==NULL){
                 $obj->src = url('/')."/common_images/no-store.png";
            }else{
                $obj->src = CommonHelper::getImageUrl($obj->avatar);
            }
        }
        $map = json_encode($map);
        return view("frontend.mapApi",["map" => $map]); 
    }
    public function Home()
    {
        $store = SDB::table("store_store")->orderBy("id","desc")->get();
        foreach ($store as $obj) {
            if($obj->avatar==NULL){
                 $obj->src = url('/')."/common_images/no-store.png";
            }else{
                $obj->src = CommonHelper::getImageUrl($obj->avatar);
            }
        }
        $map = json_encode($store);
        return view("frontend.index",["map" => $map,"store" => $store]);
    }
    public function Search(Request $request)
    {
        $store = SDB::table("store_store")
                    ->where("name","like",'%'.$request->key.'%')
                    ->get();
        return response()->json(['store' => $store]);
    }
}
