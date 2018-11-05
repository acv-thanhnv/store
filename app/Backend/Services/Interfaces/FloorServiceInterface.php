<?php
/**
 * Created by PhpStorm.
 * User: SonMT
 * Date: 11/2/2018
 * Time: 10:52 AM
 */

namespace App\Backend\Services\Interfaces;


interface FloorServiceInterface
{
    //Floor
    public function getMyFloor($storeId);
    public function addFloor($obj);
    public function getById($id);
    public function editFloor($obj);
    public function deleteTable($id);
    public function deleteAllTable($arrId);
}