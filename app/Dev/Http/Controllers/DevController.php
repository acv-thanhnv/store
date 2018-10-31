<?php
/**
 * @author thanhnv
 */

namespace App\Dev\Http\Controllers;
use App\Dev\Rules\UpperCaseRule;
use App\Dev\Services\Interfaces\AclServiceInterface;
use App\Dev\Services\Interfaces\DevServiceInterface;
use App\Dev\Services\Interfaces\TranslateServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Core\Common\SDBStatusCode;
use Validator;
use App\Core\Events\OrderPusherEvent;

class DevController extends Controller
{
    protected $devService;
    protected $aclService;
    protected $translateService;

    /**
     * Constructor
     */
    public function __construct(DevServiceInterface $devService, AclServiceInterface $aclService , TranslateServiceInterface $translateService)
    {
        $this->devService = $devService;
        $this->aclService = $aclService;
        $this->translateService = $translateService;
    }
    public function initProject()
    {
        $this->aclService->initRoleDataToDB();
        $this->aclService->generationAclFile();
        //generationTranslate validation
        $this->translateService->generationTransDataToDB();
    }

    /**
     * test readAcl file
     */
    public function readAclConfig()
    {
        $a = $this->devService->getConfigDataFromFile('acl');
        echo '<prev>';
        print_r($a);
    }

    public function index()
    {
        return view("dev/index");
    }

    public function testCustomValidate(Request $request)
    {
        $validator =
            Validator::make($request->all(), [
                'text_code' => ['required',new UpperCaseRule()]
            ]);
        if ($validator->fails()) {
            dd($validator->errors());
        }
    }
    public function entityManagement(){
        $listSPCollection =  $this->devService->getAllSPList();
        $listSp = $listSPCollection->status==SDBStatusCode::OK?$listSPCollection->data:array();
        return view("dev/entitymanagement", compact('listSp'));
    }
    public function generateEntity()
    {
        $this->devService->generateEntityClass();
    }
    public function generateOneEntity(Request $request)
    {
        $spName = $request->input('name');
        $this->devService->generateSpecEntityClass($spName);
    }
    public function doc(){
        return view("dev/document");
    }
    public function log(){
        return view("dev/log");
    }
    public function runSchedules(){

    }
    public function test()
    {
        event(new OrderPusherEvent(1, 2, 3,4, 5,6,7,8, 9));
       // $this->devService->generationTranslateScript('validation','validation');
    }

}
