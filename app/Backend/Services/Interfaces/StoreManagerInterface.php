<?php
/**
 * Created by PhpStorm.
 * User: SonMT
 * Date: 11/9/2018
 * Time: 2:00 PM
 */

namespace App\Backend\Services\Interfaces;


interface StoreManagerInterface
{
    //Store Manager
    public function getStoreManager();
    public function addStoreManager($obj);
    public function getById($id);
    public function editStoreManager($obj);
    public function deleteStoreManager($id);
    public function deleteAllStoreManager($arrId);
}