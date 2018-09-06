<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 6/14/2018
 * Time: 10:23 AM
 */
namespace App\Dev\Services\Interfaces;
use App\Dev\Entities\DataResultCollection;

interface CategoryServiceInterface
{
    public function getCategoryWithLevelList():DataResultCollection;
    public function categoryAddChildInLeft($paramArr):DataResultCollection;
    public function categoryUpdateMenu($paramArr):DataResultCollection;
    public function categoryDeleteNodeAndChild($nodeId):DataResultCollection;
}
