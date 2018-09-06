<?php

namespace App\Api\V1\Http\Controllers;
use App\Core\Dao\SDB;
use App\Core\Helpers\ResponseHelper;
class CateloryController extends Controller
{
    public function index(){

        $listCategory = SDB::select("SELECT * FROM catelory");
        return ResponseHelper::JsonDataResult($listCategory);
    }
}
