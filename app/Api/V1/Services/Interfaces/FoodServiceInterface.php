<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 6/14/2018
 * Time: 10:23 AM
 */

namespace App\Api\V1\Services\Interfaces;

use Illuminate\Http\Request;

interface FoodServiceInterface
{
    public function getFoodByStoreId($storeId);

    public function getFoodByMenuId($menuId,$storeId);

    public function getMenuList($storeId);

}
