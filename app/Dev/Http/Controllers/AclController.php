<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 8/3/2018
 * Time: 10:59 AM
 */

namespace App\Dev\Http\Controllers;

use App\Dev\Services\Interfaces\AclServiceInterface;
use Validator;
use Illuminate\Http\Request;
use App\Dev\Helpers\CommonHelper;

class AclController
{
    protected $service;
    public function __construct(AclServiceInterface $aclService)
    {
        $this->service = $aclService;
    }
    public function generationAclConfigFiles()
    {
        $this->service->generationAclFile();
    }


    public function importScreensList()
    {
        $this->service->initRoleDataToDB();
    }
    public function generationAclFile()
    {
        $this->service->generationAclFile();
        return null;
    }

    public function refreshAclDB(){
        $this->service->generationRoleDataToDB();
    }
    public function aclManangement()
    {
        $dataAcl = $this->service->getRoleInfoFromDB();
        $roleList =  $this->service->getRoleList();
        $moduleList =$this->service->getModuleList();
        return view("dev/acl", compact(['dataAcl','roleList','moduleList']));
    }
    public function updateAclActive(Request $request)
    {
        $active = $request->input('active');
        $roleMapId = $request->input('role_map_id');
        $isActive = 0;
        if (isset($active) && strtolower($active) == 'true') {
            $isActive = 1;
        }
        $this->service->updateActiveAcl($roleMapId, $isActive);
        return CommonHelper::convertVaidateErrorToCommonStruct(array());
    }
    public function updateAclActiveAll(Request $request){
        $active = $request->input('active');
        $isActive = 0;
        if (isset($active) && strtolower($active) == 'true') {
            $isActive = 1;
        }
        $this->service->updateActiveAclAll( $isActive);
        return CommonHelper::convertVaidateErrorToCommonStruct(array());
    }

    public function userRole(){
        $dataUseRole = $this->service->getListUser();
        $roleList =  $this->service->getRoleList();

        return view("dev.userRole", compact(['dataUseRole','roleList']));
    }

    public function updateUserRole(Request $request){
        $current_id = $request->input('$current_id');
        $current_role_value = $request->input('$current_role_value');
        $this->service->updateUserRole($current_id, $current_role_value);
        return CommonHelper::convertVaidateErrorToCommonStruct(array());
    }

}
