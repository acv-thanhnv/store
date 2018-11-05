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
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;


class TableController
{
    protected $TableService;
    protected $storeId;
    public function __construct(TableServiceInterface $TableService)
    {
        $this->TableService   = $TableService;
    }
    public function getMyTable(Request $request){
        $storeId = 1;
        $Table= $this->TableService->getMyTable($storeId);
        $result = new DataResultCollection();
        $result->status = SDBStatusCode::OK;
        $result=$Table;
        //dd($result);
        return view("backend.table.list",["table" =>$result]);
    }

    public function getAddTable()
    {
        return view("backend.table.add");
    }

    public function postAddTable(Request $request)
    {
        $result             = new DataResultCollection();
        $rule               = ["name" => "required|array|min:3"];
        $validator          = Validator::make($request->all(),$rule);
        $obj=array([
            'name'=>$request->name,
            'type_location_id'=>$request->type,
            'floor_id'=>$request->floor,
            'price'=>$request->price,
        ]);

        if(!$validator->fails()){
            $this->service->addTable($obj);
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

//    public function insert($obj)
//    {
//        try {
//            SDB::beginTransaction();
//            SDB::table("store_table")->insert([
//                "name" => $obj->name,
//                "type_location_id" => $obj->type,
//                "floor_id" => $obj->floor,
//                "price" => $obj->price,
//            ]);
//
//            SDB::commit();
//        } catch (\Exception $e) {
//            SDB::rollBack();
//        }
//    }

    public function update($obj)
    {
        //check pass and insert into table users
        if (isset($obj->pass)) {
            SDB::table("users")
                ->where("id", $obj->id)
                ->update([
                    "name"       => $obj->name,
                    "email"      => $obj->email,
                    "is_active"  => $obj->active,
                    "role_value" => $obj->role,
                    "password"   => $obj->pass
                ]);
        } else {
            SDB::table("users")
                ->where("id", $obj->id)
                ->update([
                    "name"       => $obj->name,
                    "email"      => $obj->email,
                    "is_active"  => $obj->active,
                    "role_value" => $obj->role
                ]);
        }
        //check image and insert into table users_details
        if ($obj->image != NULL) {
            SDB::table("users_detail")
                ->where("user_id", $obj->id)
                ->update([
                    "gender" => $obj->gender,
                    "birth_date" => $obj->date,
                    "avatar" => $obj->image
                ]);
        } else {
            SDB::table("users_detail")
                ->where("user_id", $obj->id)
                ->update([
                    "gender" => $obj->gender,
                    "birth_date" => $obj->date
                ]);
        }
    }

}