<?php

namespace App\Frontend\Http\Controllers;
use App\Api\V1\Services\Production\FoodService;
use App\Core\Common\CutomerConst;
use App\Core\Common\SDBStatusCode;
use App\Core\Common\StorageConst;
use App\Core\Common\StorageDisk;
use App\Core\Dao\SDB;
use App\Core\Entities\DataResultCollection;
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
    public function ClosestStore(Request $request)
    {
        $result =  new DataResultCollection();
        $page = $request->page;
        $q_name;
        $q_radius;
        if($page<1){
            $page = 1;
        }
        $limit = CutomerConst::limit;
        $key = $request->key;
        $unit = $request->unit;
        switch ($unit) {
            case 'm':
                $q_name=null;
                if($key==null){
                    $q_radius ='null';
                }else{
                    $q_radius =(float) $key/1000;
                }
                break;
            case 'km':
                $q_name = null;
                if($key==null){
                    $q_radius ='null';
                }else{
                    $q_radius =(float) $key;
                }
                break;
            default:
                $q_radius = 'null';
                $q_name = $key;  
                break;
        }
        $start = ($limit * $page) - $limit;
        $diskLocalName = StorageDisk::diskLocalName;
        $arrStore = SDB::select(SDB::raw("call get_distance($request->lat,$request->lng,$start,$limit,'$q_name',$q_radius)"));
        $total = count(SDB::select(SDB::raw("call get_distance($request->lat,$request->lng,0,10000000,'$q_name',$q_radius)")));
        $numberPage = (int) ceil($total/$limit);
        foreach($arrStore as $obj){
            //check avatar
            if($obj->avatar==NULL){
                $obj->src = url('/')."/common_images/no-store.png";
            }else{
                $obj->src = CommonHelper::getImageUrl($obj->avatar);
            }
            //custom distance
            if($obj->distance_in_km<1){
                $obj->distance_in_km = (sprintf('%.1f',$obj->distance_in_km)*1000)." Meters";
            }else{
                $obj->distance_in_km = sprintf('%.1f',$obj->distance_in_km) ." Km";
            }
        }
        $result->status = SDBStatusCode::OK;
        $result->arrStore = $arrStore;
        $result->numberPage = $numberPage;
        $result->page = $page;
        return ResponseHelper::JsonDataResult($result);
    }
    public function Home()
    {
        $store = SDB::table("store_store")
                        ->select()
                        ->orderBy("priority","desc")
                        ->take(10)
                        ->get();
        foreach ($store as $obj) {
            if($obj->avatar==NULL){
                 $obj->src = url('/')."/common_images/no-store.png";
            }else{
                $obj->src = CommonHelper::getImageUrl($obj->avatar);
            }
        }
        
        $limit = CutomerConst::limit;
        $paginate = SDB::table("store_store")->paginate(5);
        $paginate = json_encode($paginate);
        $map = json_encode($store); 
        return view("frontend.index",[
            "map"      => $map,
            "store"    => $store,
            "paginate" => $paginate
        ]);
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
