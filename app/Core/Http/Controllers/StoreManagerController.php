<?php
/**
 * Created by PhpStorm.
 * User: SonMT
 * Date: 11/9/2018
 * Time: 2:02 PM
 */

namespace App\Core\Http\Controllers;
use App\Backend\Services\Interfaces\StoreManagerInterface;
use App\Backend\Services\Interfaces\UserServiceInterface;
use App\Backend\Services\Production\StoreManagerService;
use App\Core\Common\SDBStatusCode;
use App\Core\Dao\SDB;
use App\Core\Entities\DataResultCollection;
use App\Core\Helpers\CommonHelper;
use App\Core\Helpers\ResponseHelper;
use App\Core\Services\Interfaces\UploadServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function MongoDB\BSON\toJSON;

class StoreManagerController
{
    protected $storeService;
    protected $userService;
    protected $uploadService;

    public function __construct(UploadServiceInterface $uploadService,StoreManagerInterface $storeService,UserServiceInterface $userService)
    {
        $this->storeService  = $storeService;
        $this->uploadService = $uploadService;
        $this->userService   = $userService;
    }
    public function getStoreManager(Request $request){
        $store          = $this->storeService->getStoreManager();
        $result         = new DataResultCollection();
        $result->status = SDBStatusCode::OK;
        $result->data   = $store;
        return view("backend.store_manager.list",["store" =>$result]);
    }
    public function addStoreManager(Request $request)
    {
        return view("backend.store_manager.add");
    }

    public function addUser(Request $request)
    {
        $arrRole = SDB::table('sys_roles')->get();
        return view('backend.store_manager.addUser',["arrRole" => $arrRole]);
    }

    public function postAddUser(Request $request)
    {
        $idStore = $request->idStore;
        $image  = $request->file("image");
        $result =  new DataResultCollection();
        $rule_image = "";
        if($image!=NULL){
            $rule_image = "mimes:".UploadConst::FILE_IMAGE_UPLOAD_ACCESSED."|image|max:".UploadConst::BACKEND_UPLOAD_IMAGE_MAX;
        }
        $rule   = [
            "image" => $rule_image,
            "name"  => "required|min:3|max:32",
            "date"  => "required|date",
            "email" => "required|email|unique:users",
            "pass"  => "required|min:3|max:32",
            "role"  => "required"
        ];
        $message_rule = [
            '*.mimes' => 'Mime not Allowed'
        ];
        $validator = Validator::make($request->all(),$rule,$message_rule);
        if (!$validator->fails()) {
            if($image!=NULL){
                $result = $this->uploadService->uploadFile(array($image),$diskLocalName,'uploads/avatars','');
                foreach ($result->data as $data){
                    $imageUrl = $data["uri"];
                }
            } else{
                $result->status = SDBStatusCode::OK;
            }

        } else {
            $error           = array($validator->errors());
            $result->status  = SDBStatusCode::ValidateError;
            $result->message = 'An error occured while uploading avatar or validate!';
            $result->data    =$error;
        }
        if($result->status==SDBStatusCode::OK){
            $obj        = new \stdClass();
            $obj->image = NULL;
            if($image!=NULL){
                $obj->image  = $imageUrl;
            }
            $obj->name   = $request->name;
            $obj->date   = $request->date;
            $obj->gender = $request->gender;
            $obj->email  = $request->email;
            $obj->pass   = Hash::make($request->pass);
            $obj->role   = $request->role;
            $this->service->insert($obj);
        }
        dd($idStore);
    }

    public function postAddStoreManager(Request $request)
    {
        $result             = new DataResultCollection();
        $rule               = [
                                "name"    => "required|min:3",
                                'address' => 'required|min:3',
                                'lng'     => 'required',
                                'lat'     => 'required',
                                ];
        $obj['name']        = $request->name;
        $obj['address']     = $request->address;
        $obj['avatar']      = $request->image;
        $obj['lat']         = $request->lat;
        $obj['lng']         = $request->lng;
        $obj['description'] = $request->description;
        $obj['priority']    = $request->priority;
        $validator          = Validator::make($request->all(),$rule);
        if(!$validator->fails()){
            $idStore         = $this->storeService->addStoreManager($obj);
            $result->status  = SDBStatusCode::OK;
            $result->idStore = $idStore;
            $result->message = 'Success';
        }else {
            $error           = $validator->errors();
            $result->status  = SDBStatusCode::ValidateError;
            $result->message = 'An error occured when validate!';
            $result->data    = $error;
        }
        return ResponseHelper::JsonDataResult($result);
    }

    public function getEditStoreManager(Request $request)
    {
        $obj = $this->storeService->getById($request->id);
        return view("backend.store_manager.edit",["obj" => $obj]);
    }

    public function postEditStoreManager(Request $request)
    {
        $result     = new DataResultCollection();
        $rule       = [
                        "name"    => "required|min:3",
                        'address' => 'required|min:3',
                        'lng'     => 'required',
                        'lat'     => 'required',
                    ];
        $obj = new \stdClass;
        $obj->idStore     = $request->idStore;
        $obj->name        = $request->name;
        $obj->address     = $request->address;
        $obj->avatar      = $request->image;
        $obj->lat         = $request->lat;
        $obj->lng         = $request->lng;
        $obj->description = $request->description;
        $obj->priority    = $request->priority;
        $validator = Validator::make($request->all(),$rule);
        if(!$validator->fails()){
            $this->storeService->editStoreManager($obj);
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
    public function deleteStoreManager(Request $request)
    {
        $this->storeService->deleteFloor($request->id);
    }
    public function deleteAllStoreManager(Request $request)
    {
        $this->storeService->deleteAllFloor($request->arrId);
    }


}