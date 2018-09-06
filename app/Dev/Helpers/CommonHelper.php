<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 6/21/2018
 * Time: 9:32 AM
 */

namespace App\Dev\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use App\Core\Common\SDBStatusCode;

class CommonHelper
{
    /**
     * @param $dataArray
     * @return string
     */
    public static function generateResponeJSON($dataArray){
        $result = array(
            'status'=>array(),
            'data'=>array()
        );
        $count= 0;
        if(isset($dataArray) && is_array($dataArray))
            $count = count($dataArray);
        if($count>=1){
            $result['status'] = $dataArray[0];
        }
        for($i=1;$i<$count;$i++){
            $result['data'][] =$dataArray[$i];
        }
        return json_encode($result);
    }

    /**
     * @param $error
     * @return array
     */
    public static function convertVaidateErrorToCommonStruct($error){
        $result = array(
            array(
                'code'=>SDBStatusCode::WebError,
                'data_error'=>json_encode($error)
            )
        );

        return $result;
    }
    public static function CommonLog($message){
        //Logging
        if(env('APP_DEBUG')==true){
            abort($message);
        }else{
            Log::error($message);
        }
    }
}
