<?php

namespace App\Manager\Http\Controllers;

use Illuminate\Http\Request;
use App\Manager\Http\Controllers\Controller;
use App\Api\V1\Services\Interfaces\FoodServiceInterface;
use Illuminate\Support\Facades\DB;

class OrderManagerController extends Controller
{
    protected $foodService;

    public function __construct(FoodServiceInterface $foodService)
    {
        $this->foodService = $foodService;
    }

    public function index(Request $request)
    {
        $idStore= $request->idStore;
        //dd($idStore);
        return view('frontend.order-manager.index',["idStore" => $idStore]);
    }

    public function getMenuListByStoreId(Request $request)
    {
        $idStore=$request->idStore;

        $menulist = $this->foodService->getMenuList($idStore);
        return response()->json(array("menu" => $menulist));
    }

}
