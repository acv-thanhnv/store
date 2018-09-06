<?php
namespace App\Core\Helpers;
/**
 * Created by PhpStorm.
 * User: my computer
 * Date: 6/30/2018
 * Time: 2:05 AM
 */
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
class CommonHelper
{
    public static function CommonLog($message){
        //Logging
        if(env('APP_DEBUG')==true){
           die($message);
            abort($message);
        }else{
            Log::error($message);
        }
    }

    /**
     * @return ModuleInfor
     */
    public static function getCurrentModuleInfor():ModuleInfor{
        $result = new ModuleInfor();
        try{
            $currentRoute =  Route::getCurrentRoute();
            if($currentRoute !=null){
                $curentActionInfo = $currentRoute->getAction();
                $module = strtolower(trim(str_replace('App\\', '', $curentActionInfo['namespace']), '\\'));
                $module =  explode("\\",$module)[0];
                $_action =isset($curentActionInfo['controller'])? explode('@', $curentActionInfo['controller']):array();
                $_namespaces_chunks =isset($_action[0])? explode('\\', $_action[0]):array();
                $controllers = strtolower(end($_namespaces_chunks));
                $action = strtolower(end($_action));
                $screenCode = $curentActionInfo['namespace']."\\".$controllers."\\".$action;

                $result->module = $module;
                $result->controller = $controllers;
                $result->action = $action;
                $result->screenCode = $screenCode;
            }

        }catch (\Exception $ex){
            //Dont handler here...
        }
        return $result;
    }
    public static function getExcelTemplatePath(){
        return base_path().'/resources/export_templates/';
    }

}
