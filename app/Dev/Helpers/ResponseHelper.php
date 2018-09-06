<?php
namespace App\Dev\Helpers;
/**
 * Created by PhpStorm.
 * User: my computer
 * Date: 6/30/2018
 * Time: 2:05 AM
 */
use App\Dev\Entities\DataResultCollection;
class ResponseHelper
{
    public static function JsonDataResult(DataResultCollection $data){
        return response()->json($data);
    }

}
