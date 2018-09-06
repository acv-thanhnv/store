<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 6/14/2018
 * Time: 10:23 AM
 */
namespace App\Acl\Services\Interfaces;

interface AclServiceInterface
{
    public function test();
    public function getRoleInfoFromDB();
    public function getRoleMapArray();
    public function generationAclFile();
    public function getConfigDataFromFile($name);

    public function updateActiveAcl($roleMapId,$isActive);
    public function updateActiveAclAll($isActive);
    public function getRoleList();
}
