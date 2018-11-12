<?php
/**
 * Created by PhpStorm.
 * User: SonMT
 * Date: 11/2/2018
 * Time: 10:52 AM
 */

namespace App\Backend\Services\Interfaces;


interface TableServiceInterface
{
    //Table
    public function getMyTable($storeId);
    public function addTable($obj);
    public function getFloor($storeId);
    public function getTypeLocation($storeId);
    public function getById($obj);
    public function editTable($obj);
    public function deleteTable($obj);
    public function deleteAllTable($obj);
}