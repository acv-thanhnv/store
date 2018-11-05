<?php
/**
 * Created by PhpStorm.
 * User: SonMT
 * Date: 11/2/2018
 * Time: 10:53 AM
 */

namespace App\Backend\Http\Controllers;
use App\Backend\Services\Interfaces\TableServiceInterface;
use App\Backend\Services\Production\TableService;
use App\Core\Helpers\CommonHelper;
use App\Core\Entities\DataResultCollection;
use App\Core\Common\SDBStatusCode;
use App\Core\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;


class TableController
{
    protected $TableService;
    protected $storeId;
    public function __construct(TableServiceInterface $tableService)
    {
        $this->tableService   = $tableService;
    }
    public function getMyTable(Request $request){
        $storeId = 1;
        $table= $this->tableService->getMyTable($storeId);
        $result = new DataResultCollection();
        $result->status = SDBStatusCode::OK;
        $result=$table;
        //dd($result);
        return view("backend.table.list",["table" =>$result]);
    }

    public function getAddTable(Request $request)
    {
        $storeId=$request->storeId;
        $type=$this->tableService->getTypeLocation();
        $floor = $this->tableService->getFloor(1);
        return view("backend.table.add",['floor'=>$floor, 'type'=>$type]);
    }

    public function postAddTable(Request $request)
    {
        $result             = new DataResultCollection();
        $rule               = ["name" => "required|min:3"];
        $validator          = Validator::make($request->all(),$rule);
        $obj=array([
            'name'=>$request->name,
            'type_location_id'=>$request->type,
            'floor_id'=>$request->floor,
            'price'=>$request->price,
        ]);

        if(!$validator->fails()){
            $this->tableService->addTable($obj);
            $result->status   = SDBStatusCode::OK;
            $result->message  = 'Success';
        }else {
            $error           = $validator->errors();
            $result->status  = SDBStatusCode::ValidateError;
            $result->message = 'An error occured when validate!';
            $result->data    = $error;
        }
        return ResponseHelper::JsonDataResult($result);
    }

    public function getEditTable(Request $request)
    {
        $storeID =$request->storeId;
        $type=$this->tableService->getTypeLocation();
        $floor = $this->tableService->getFloor(1);
        $obj = $this->tableService->getById($request->id);
        return view("backend.table.edit",["obj" => $obj, "type"=>$type,"floor"=>$floor]);
    }

    public function update(Request $request)
    {
        $result    = new DataResultCollection();
        $rule      = ["name" => "required|min:3"];
        $validator = Validator::make($request->all(),$rule);
        if(!$validator->fails()){
            $obj              = new \stdClass();
            $obj->id          = $request->id;
            $obj->name        = $request->name;
            $obj->type        = $request->type;
            $obj->floor        = $request->floor;
            $obj->price        = $request->price;
            $this->tableService->editTable($obj);
            $result->status   = SDBStatusCode::OK;
            $result->message  = 'Success';
        }else {
            $error           = $validator->errors();
            $result->status  = SDBStatusCode::ValidateError;
            $result->message = 'An error occured when validate!';
            $result->data    = $error;
        }
        return ResponseHelper::JsonDataResult($result);
    }
    public function deleteTable(Request $request)
    {
        $this->tableService->deleteTable($request->id);
    }
    public function deleteAllTable(Request $request)
    {
        $this->tableService->deleteAllTable($request->arrId);
    }

}