<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 6/14/2018
 * Time: 10:23 AM
 */
namespace App\Backend\Services\Interfaces;

interface UserServiceInterface
{
    public function getAll();
    public function delete($id);
    public function deleteAll($arrUser);
    public function getById($id);
    public function getRole();
    public function insert($obj);
    public function update($obj);

}
