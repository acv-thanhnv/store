<?php
/**
 * Created by PhpStorm.
 * User: SonMT
 * Date: 11/2/2018
 * Time: 10:53 AM
 */

namespace App\Backend\Http\Controllers;
use App\Backend\Services\Interfaces\FloorServiceInterface;
use App\Backend\Services\Production\FloorService;
use App\Core\Helpers\CommonHelper;
use App\Core\Entities\DataResultCollection;
use App\Core\Common\SDBStatusCode;
use App\Core\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;


class FloorController
{
    protected $floorService;
    protected $storeId;
    public function __construct(FloorServiceInterface $floorService)
    {
        $this->floorService   = $floorService;
    }
    public function getMyFloor(Request $request){
        $storeId = 1;
        $floor= $this->floorService->getMyFloor($storeId);
        $result = new DataResultCollection();
        $result->status = SDBStatusCode::OK;
        $result->data=$floor;
        return view("backend.floor.list",["floor" =>$result]);
    }

    public function insert($obj)
    {
        try {
            SDB::beginTransaction();
            SDB::table("store_floor")->insert([
                "name" => $obj->name,
            ]);

            SDB::commit();
        } catch (\Exception $e) {
            SDB::rollBack();
        }
    }



}