<?php

namespace App\Frontend\Http\Controllers;
use App\Api\V1\Services\Production\FoodService;
use App\Core\Common\CutomerConst;
use App\Core\Common\StorageConst;
use App\Core\Common\StorageDisk;
use App\Core\Dao\SDB;
use App\Core\Helpers\CommonHelper;
use App\Core\Helpers\ResponseHelper;
use App\Frontend\Model\StoreModel;
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
        $page = $request->page;
        if($page<1){
            $page = 1;
        }
        $limit = 5;
        $start = ($limit * $page) - $limit;
        //$diskLocalName = StorageDisk::diskLocalName;
        $diskLocalName = "public";
        $arrStore = SDB::select(SDB::raw("call get_distance($request->lat,$request->lng,$start,$limit)"));
        $total = count($arrStore);
        foreach($arrStore as $obj){
            //check avatar
            if($obj->avatar==NULL){
                $obj->src = url('/')."/common_images/no-store.png";
            }else{
                $obj->src = CommonHelper::getImageUrl($obj->avatar);
            }
            // //custom distance
            // if($obj->distance_in_km<1){
            //     $obj->distance_in_km = (sprintf('%.1f',$obj->distance_in_km)*1000)." Meters";
            // }else{
            //     $obj->distance_in_km = sprintf('%.1f',$obj->distance_in_km) ." Km";
            // }
        }
        return response()->json(["arrStore" => $arrStore,"total" => $total]);
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
        $limit = CutomerConst::limit;
        $paginate = SDB::table("store_store")->paginate(5);
        $map = json_encode($store);
        return view("frontend.index",[
            "map"      => $map,
            "store"    => $store,
            "paginate" => $paginate
        ]);
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

//calculate distance between two point
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
