<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 6/14/2018
 * Time: 10:23 AM
 */
namespace App\Dev\Services\Interfaces;
use App\Dev\Entities\DataResultCollection;

interface DevServiceInterface
{
    public function test();
    public function getAllSPList():DataResultCollection;
    public function getConfigDataFromFile($name);

    public function generateEntityClass();
    public function generateSpecEntityClass($spName);
}
