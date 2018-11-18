<?php

namespace App\Manager\Http\Controllers;
use App\Core\Events\TestPusher;
use Illuminate\Http\Request;
use App\Manager\Http\Controllers\Controller;
use App\Api\V1\Services\Interfaces\FoodServiceInterface;

class OrderManagerController extends Controller
{
    protected $foodService;

    public function __construct(FoodServiceInterface $foodService)
    {
        $this->foodService = $foodService;
    }

    public function index(Request $request)
    {
        $idStore = $request->idStore;
        return view('frontend.order-manager.index', ["idStore" => $idStore]);
    }

//    public function getMenuListByStoreId(Request $request)
//    {
//        $idStore = $request->idStore;
//        $menulist = $this->foodService->getMenuList($idStore);
//        $menulist = json_encode($menulist);
//        return $menulist;
//    }
//
//    public function getEntitiesByStoreID(Request $request)
//    {
//        $idStore = $request->idStore;
//        $entities = $this->foodService->getFoodByStoreId($idStore);
//        return response()->json($entities);
//    }
//
//    public function getEntitiesByMenuId(Request $request)
//    {
//        $idMenu=$request->idMenu;
//        $idStore=$request->idStore;
//        $entities = $this->foodService->getFoodByMenuId($idMenu,$idStore);
//        return response()->json($entities);
//    }
    public function sendNotification($message = 'Hello')
    {
        event(new TestPusher('123'));
    }

}
