<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 6/14/2018
 * Time: 10:23 AM
 */
namespace App\Dev\Services\Interfaces;
use App\Dev\Entities\DataResultCollection;

interface AclServiceInterface
{
    public function getRoleInfoFromDB();
    public function getRoleMapArray();
    public function generationAclFile();
    public function updateActiveAcl($roleMapId,$isActive);
    public function updateActiveAclAll($isActive);
    public function getRoleList();
    public function getModuleList();
    public function getListUser();
    public function updateUserRole($current_id,$current_role_value);
    public function generationRoleDataToDB();
    public function initRoleDataToDB();
}
