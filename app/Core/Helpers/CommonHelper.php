<?php
namespace App\Core\Helpers;
/**
 * Created by PhpStorm.
 * User: my computer
 * Date: 6/30/2018
 * Time: 2:05 AM
 */
use App\Core\Common\OrderConst;
use App\Core\Dao\SDB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Session;
class CommonHelper
{
    public static function CommonLog($message){
        //Logging
        if(env('APP_DEBUG')==true){
            abort($message);
        }else{
            Log::error($message);
        }
    }
    //get Image Url
    public static function getImageUrl($imageUri,$diskLocalName = "public")
    {
        $imageUrl = Storage::disk($diskLocalName)->url($imageUri);
        return $imageUrl;
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
    /**
     * @return ModuleInfor
     */
    public static function getModuleInforByRouter($routerName):ModuleInfor{
        $result = new ModuleInfor();
        try{
            $currentRoute =  Route::getRoutes()->getByName($routerName);
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
    public static function getOrderEventName($storeId,$orderChannel){
        $hash = md5 ($storeId);
        return $hash."-".$orderChannel;
    }

    public static function existsStore($storeId){
        $store = SDB::table('store_store')->where('id',$storeId)->first();
        if(!empty($store)){
            return true;
        }
        return false;
    }
    //Get store id
    public static function getStoreId(){
        $userId = AuthHelper::getUserInfor()->id;
        $store = SDB::table('store_user_store')
            ->whereRaw('store_user_store.user_id = ?',[$userId])
            ->select('store_user_store.store_id')
            ->first();
        if(!empty($store) && isset($store->store_id)){
            return $store->store_id;
        }
        return 0;
    }
    public static function changeTitle($str,$strSymbol='_',$case=MB_CASE_LOWER){// MB_CASE_UPPER / MB_CASE_TITLE / MB_CASE_LOWER
        $str=trim($str);
        if ($str=="") return "";
        $str =str_replace('"','',$str);
        $str =str_replace("'",'',$str);
        $str = self::stripUnicode($str);
        $str = mb_convert_case($str,$case,'utf-8');
        $str = preg_replace('/[\W|_]+/',$strSymbol,$str);
        return $str;
    }
    public static function stripUnicode($str){
        if(!$str) return '';
        //$str = str_replace($a, $b, $str);
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|å|ä|æ|ā|ą|ǻ|ǎ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|Å|Ä|Æ|Ā|Ą|Ǻ|Ǎ',
            'ae'=>'ǽ',
            'AE'=>'Ǽ',
            'c'=>'ć|ç|ĉ|ċ|č',
            'C'=>'Ć|Ĉ|Ĉ|Ċ|Č',
            'd'=>'đ|ď',
            'D'=>'Đ|Ď',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|ë|ē|ĕ|ę|ė',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ë|Ē|Ĕ|Ę|Ė',
            'f'=>'ƒ',
            'F'=>'',
            'g'=>'ĝ|ğ|ġ|ģ',
            'G'=>'Ĝ|Ğ|Ġ|Ģ',
            'h'=>'ĥ|ħ',
            'H'=>'Ĥ|Ħ',
            'i'=>'í|ì|ỉ|ĩ|ị|î|ï|ī|ĭ|ǐ|į|ı',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị|Î|Ï|Ī|Ĭ|Ǐ|Į|İ',
            'ij'=>'ĳ',
            'IJ'=>'Ĳ',
            'j'=>'ĵ',
            'J'=>'Ĵ',
            'k'=>'ķ',
            'K'=>'Ķ',
            'l'=>'ĺ|ļ|ľ|ŀ|ł',
            'L'=>'Ĺ|Ļ|Ľ|Ŀ|Ł',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|ö|ø|ǿ|ǒ|ō|ŏ|ő',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|Ö|Ø|Ǿ|Ǒ|Ō|Ŏ|Ő',
            'Oe'=>'œ',
            'OE'=>'Œ',
            'n'=>'ñ|ń|ņ|ň|ŉ',
            'N'=>'Ñ|Ń|Ņ|Ň',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|û|ū|ŭ|ü|ů|ű|ų|ǔ|ǖ|ǘ|ǚ|ǜ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|Û|Ū|Ŭ|Ü|Ů|Ű|Ų|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ',
            's'=>'ŕ|ŗ|ř',
            'R'=>'Ŕ|Ŗ|Ř',
            's'=>'ß|ſ|ś|ŝ|ş|š',
            'S'=>'Ś|Ŝ|Ş|Š',
            't'=>'ţ|ť|ŧ',
            'T'=>'Ţ|Ť|Ŧ',
            'w'=>'ŵ',
            'W'=>'Ŵ',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ|ÿ|ŷ',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ|Ÿ|Ŷ',
            'z'=>'ź|ż|ž',
            'Z'=>'Ź|Ż|Ž'
        );
        foreach($unicode as $khongdau=>$codau) {
            $arr=explode("|",$codau);
            $str = str_replace($arr,$khongdau,$str);
        }
        return $str;
    }
    //Convert to json
    public static function toJson($obj){
        $obj = json_encode($obj);
        return $obj;
    }

}
