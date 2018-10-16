<?php

namespace App\Frontend\Http\Controllers;
use App\Api\V1\Services\Production\FoodService;
use App\Core\Common\StorageConst;
use App\Core\Common\StorageDisk;
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
    public function ClosestStore(Request $request)
    {
        $diskLocalName = "public";
        $arrStore = SDB::table("store_store")->get();
        $arrClosest = Array();
        foreach($arrStore as $obj){
            $distance = distance($obj->lat,$obj->lng,$request->lat,$request->lng,'M');
            if($distance<=1000){//check distance between now with other store
                //check avatar
                if($obj->avatar==NULL){
                    $obj->src = url('/')."/common_images/no-store.png";
                }else{
                    $obj->src = CommonHelper::getImageUrl($obj->avatar);
                }
                $obj->distance = (int) $distance;
                $arrClosest[]=[$obj];
            }
        }
        return response()->json(["arrClosest" => $arrClosest]);
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
        $store = SDB::table("store_store")->select()->get();
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
    public function Contact()
    {
        return view("frontend.contact");
    }
}
function distance($lat1, $lon1, $lat2, $lon2, $unit) {

    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
        return ($miles * 1.609344);
    } else {
        return $miles*1.609344*1000;
    }
}
