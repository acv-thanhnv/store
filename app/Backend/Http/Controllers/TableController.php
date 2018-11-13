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
use App\Core\Common\SDBStatusCode;
use App\Core\Dao\SDB;
use App\Core\Entities\DataResultCollection;
use App\Core\Helpers\CommonHelper;
use App\Core\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        $storeId = CommonHelper::getStoreId();
        $table= $this->tableService->getMyTable($storeId);
        $result = new DataResultCollection();
        $result->status = SDBStatusCode::OK;
        $result=$table;
        //dd($result);
        return view("backend.table.list",["table" =>$result]);
    }

    public function getAddTable(Request $request)
    {
        $storeId = CommonHelper::getStoreId();
        $type    =$this->tableService->getTypeLocation($storeId);
        $floor   = $this->tableService->getFloor($storeId);
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
        $storeId = CommonHelper::getStoreId();
        $type    = $this->tableService->getTypeLocation($storeId);
        $floor   = $this->tableService->getFloor($storeId);
        $obj     = $this->tableService->getById($request->id);
        return view("backend.table.edit",["obj" => $obj, "type"=>$type,"floor"=>$floor]);
    }

    public function tablePrice(Request $request)
    {
        $price = SDB::table('store_type_location')
                ->where('id',$request->idType)
                ->select('subprice')
                ->get();
        return $price[0]->subprice;
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

    //Type Table
    public function getTypeTable(Request $request){
        $storeId = CommonHelper::getStoreId();
        $table_type = $this->tableService->getTypeTable($storeId);
        $result = new DataResultCollection();
        $result->status = SDBStatusCode::OK;
        $result=$table_type;
        return view("backend.table.typeList",["type" =>$result]);
    }

    public function getAddTypeTable()
    {
        return view('backend.table.typeAdd');
    }

    public function postAddTypeTable(Request $request)
    {
        $storeId   = CommonHelper::getStoreId();
        $result    = new DataResultCollection();
        $rule      = [
                        "name" => "required|min:3",
                        "price" => "required|int"
                    ];
        $validator = Validator::make($request->all(),$rule);
        $obj = array([
            'name'     =>$request->name,
            'subprice' =>$request->price,
            'store_id' =>$storeId
        ]);
        if(!$validator->fails()){
            SDB::table('store_type_location')->insert($obj);
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

    public function getEditTypeTable(Request $request)
    {
        $obj = SDB::table('store_type_location')
                ->where('id',$request->id)
                ->get();
        return view('backend.table.typeEdit',['type' => $obj[0]]);
    }

    public function editType(Request $request)
    {
        $result    = new DataResultCollection();
        $rule      = [
            "name" => "required|min:3",
            "price" => "required|int"
        ];
        $validator = Validator::make($request->all(),$rule);
        if(!$validator->fails()){
            SDB::table('store_type_location')
            ->where('id',$request->id)
            ->update(['name' => $request->name,'subprice' => $request->price]);
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

    public function deleteTypeTable(Request $request)
    {
        SDB::table('store_type_location')
        ->where('id',$request->id)
        ->delete();
    }

    public function deleteAllTypeTable(Request $request)
    {
        foreach($request->arrId as $obj){
            SDB::table("store_type_location")->where("id",$obj)->delete();
        }
    }
}