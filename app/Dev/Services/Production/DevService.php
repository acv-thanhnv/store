<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 6/14/2018
 * Time: 10:28 AM
 */

namespace App\Dev\Services\Production;

use App\Dev\Dao\DEVDB;
use Illuminate\Support\Facades\Config;
use App\Core\Common\SDBStatusCode;
use App\Core\Common\CoreConst;
use App\Dev\Services\Interfaces\DevServiceInterface;
use App\Dev\Entities\DataResultCollection;
use Mockery\CountValidator\Exception;
use App\Dev\Helpers\CommonHelper;

class DevService extends BaseService implements DevServiceInterface
{
    public function getLanguageCodeList():DataResultCollection
    {
        $lang = DEVDB::execSPsToDataResultCollection('DEBUG_GET_LANGUAGE_CODE_LST');
        return $lang;
    }

    public function getTranslateList($translateType, $lang):DataResultCollection
    {
        return DEVDB::execSPsToDataResultCollection('DEBUG_GET_TRANSLATION_DATA_LST', array($translateType, $lang));
    }

    /**
     * @param $translateType
     * @return array
     * HELPER: Get data translated text by type ( validation, auth, label...)
     */
    public function getTranslateMessageArray($translateType = '')
    {
        $resuiltArr = [];
        $lang = DEVDB::execSPsToDataResultCollection('DEBUG_GET_LANGUAGE_CODE_LST');
        if ($lang->status==SDBStatusCode::OK) {

            foreach ($lang->data as $item) {
                $resuiltArr[$item->code] = array();
            }
            $rules = DEVDB::execSPsToDataResultCollection('DEBUG_GET_TRANSLATION_DATA_LST', array($translateType, ''));

            if (!empty($resuiltArr)) {
                foreach ($resuiltArr as $itemKey => $itemValue) {
                    if ($rules->status==SDBStatusCode::OK) {
                        foreach ($rules->data as $ruleItem) {
                            if ($itemKey == $ruleItem->lang_code) {
                                if ($ruleItem->type_code == '') {
                                    $resuiltArr[$itemKey][$ruleItem->code] = $ruleItem->text;
                                } else {
                                    $resuiltArr[$itemKey][$ruleItem->code][$ruleItem->type_code] = $ruleItem->text;
                                }
                            }
                        }
                    }
                }

            }
        }
        return $resuiltArr;
    }

    /**
     * @param $name : name of config file. ex: 'acl' or 'app' or 'auth'....
     * @return mixed
     * HELPER: Read file config
     */
    public function getConfigDataFromFile($name)
    {
        $resultArray = Config::get($name);
        return $resultArray;
    }

    public function generateEntityClass(){
        try{
            //Generate Storeprocedure entity
            $spsList =  DEVDB::execSPsToDataResultCollection('DEBUG_GET_ALL_SP_LST');
            $modules =  DEVDB::select('SELECT module_code FROM sys_modules');
            if($spsList->status==SDBStatusCode::OK){
                foreach ($spsList->data as $row){
                    DEVDB::generateEntityClass($row->Name,$this->getModuleNameFromSpName($row->Name,$modules));
                }
            }
            //Generate Table and View entity
            $tableList =  DEVDB::execSPsToDataResultCollection('DEBUG_GET_ALL_TABLE_LST');
            if($tableList->status==SDBStatusCode::OK){
                foreach ($tableList->data as $row){
                    DEVDB::generateEntityClassByTable($row->name);
                }
            }
        }catch (Exception $e){
            CommonHelper::CommonLog($e->getMessage());
        }
    }
    public function generateSpecEntityClass($spName){
        $modules =  DEVDB::select('SELECT module_code FROM sys_modules');
        DEVDB::generateEntityClass($spName,$this->getModuleNameFromSpName($spName,$modules));
    }
    public function getAllSPList():DataResultCollection{
        $spsList =  DEVDB::execSPsToDataResultCollection('DEBUG_GET_ALL_SP_LST');
        return $spsList;
    }
    /**
     * @param $procedureName
     * @param $modules
     * @return string
     */
    protected function getModuleNameFromSpName($procedureName,$modules){
        $result = CoreConst::CoreModuleName ;//default
        $delimiter = '_';
        $procedureName =  strtolower($procedureName);
        $listModule = array();
        if(!empty($modules)){
            foreach ($modules as $item){
                $listModule[] = $item->module_code;
            }
        }
        if(strpos($procedureName, $delimiter) !== false){
            $module =explode ($delimiter,$procedureName)[0];
            if(in_array($module,$listModule)){
                $result =  ucfirst($module);
            }
        }
        return $result;
    }
    public function test()
    {
       echo 'dev.test';
    }
}

