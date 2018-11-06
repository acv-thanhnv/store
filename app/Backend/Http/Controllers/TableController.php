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
        $result->data=$Table;
        return view("backend.Table.list",["table" =>$result]);
    }

    public function insert($obj)
    {
        try {
            SDB::beginTransaction();
            SDB::table("store_Table")->insert([
                "name" => $obj->name,
            ]);

            SDB::commit();
        } catch (\Exception $e) {
            SDB::rollBack();
        }
    }

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