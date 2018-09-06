<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 8/3/2018
 * Time: 10:44 AM
 */

namespace App\Dev\Services\Production;

use App\Dev\Dao\DEVDB;
use App\Core\Common\SDBStatusCode;
use App\Dev\Services\Interfaces\TranslateServiceInterface;
use Illuminate\Support\Facades\Lang;
use App\Dev\Entities\DataResultCollection;
class TranslationService extends BaseService implements TranslateServiceInterface
{
    /**
     * @param $validateArray
     * @param $fileName
     * HELPER: Generation Config File contain text translated.
     */
    public function generationTranslateFile($translateType, $fileName)
    {
        $validateArray = $this->getTranslateMessageArray($translateType);
        $folderLangPath = base_path() . '/resources/lang/';
        foreach ($validateArray as $langCode => $langGroupContent) {
            $langFolder = strtolower($folderLangPath . $langCode);
            if (!is_dir($langFolder)) {
                mkdir($langFolder);
            }
            $fileTranslate = $langFolder . '/' . $fileName . '.php';

            //Create file validate if not existed
            if (file_exists($fileTranslate)) {
                $fh = fopen($fileTranslate, 'w');
            } else {
                $fh = fopen($fileTranslate, 'w');
            }
            $contentFile = "<?php \n";
            $contentFile .= "//This is dev automatic generate \n ";
            //Generate content file
            if (!empty($langGroupContent)) {
                $contentFile .= "return [\n";
                if (!empty($langGroupContent)) {
                    foreach ($langGroupContent as $keycode => $value) {
                        if (!is_array($value)) {
                            $contentFile .= "\t" . '"' . $keycode . '"=>"' . $value . '"' . ",\n";
                        } else {
                            $contentFile .= "\t'" . $keycode . "'=>[\n";

                            if (!empty($value)) {
                                foreach ($value as $inputType => $text) {
                                    $contentFile .= "\t\t" . '"' . $inputType . '"=>"' . $text . '"' . ",\n";
                                }
                            }
                            $contentFile .= "\t],\n";
                        }
                    }
                }
                $contentFile .= '];';
            }
            //Write content file
            fwrite($fh, $contentFile);
            fclose($fh);
        }
    }

    /**
     * @param $validateArray
     * @param $fileName
     * HELPER: Generation Javascript File contain text translated.
     */
    public function generationTranslateScript($fileName="text")
    {
        $validateArray = $this->getTranslateMessageArray();
        $dir = base_path() . '/public/js/lang/';
        $folderLangPath = $dir. $fileName . '.js';
        //Create file validate if not existed
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        $fh = fopen($folderLangPath, 'w');
        $contentFile = "//This is dev automatic generate \n ";
        $contentFile .= "var _messageTranslation = \n";
        $txt = json_encode($validateArray);
        $contentFile .= $txt . ';';
        //Write content file
        fwrite($fh, $contentFile);
        fclose($fh);

    }

    public function generationTranslateFileAndScript()
    {
        $transTypeList = DEVDB::execSPsToDataResultCollection("DEBUG_GET_TRANSLATION_TYPE_LST");
        if ($transTypeList->status==SDBStatusCode::OK) {
            foreach ($transTypeList->data as $item) {
                $this->generationTranslateFile($item->code, $item->code);
            }
        }
        $this->generationTranslateScript();
    }

    public function getNewTransComboList()
    {
        return DEVDB::execSPs('DEBUG_ADD_TRANSLATE_COMBO_LST');
    }
    /**
     * @return array
     * generation screens list, insert to database and innitization system administrator role.
     */
    public function generationTransDataToDB()
    {
        $dir = base_path() . '/resources/lang';
        $langList = array_diff(scandir($dir), array('..', '.'));
        $id = 0;
        DEVDB::execSPsToDataResultCollection('DEBUG_BACKUP_TRANSLATE_ACT');
        DEVDB::table('sys_translation')->truncate();
        if (!empty($langList)) {
            foreach ($langList as $lang) {
                $dir = base_path() . '/resources/lang/' . $lang;
                $typeTranslateList = array_diff(scandir($dir), array('..', '.'));
                Lang::setLocale($lang);
                if (!empty($typeTranslateList)) {
                    foreach ($typeTranslateList as $translateFileName) {
                        $typeTranslate = str_replace('.php', '', $translateFileName);
                        $tran = Lang::get($typeTranslate);
                        $dataTrans = array();
                        if (is_array($tran)&&!empty($tran)) {
                            foreach ($tran as $tranItemKey => $tranItemValue) {
                                if (!is_array($tranItemValue)) {
                                    $id++;
                                    $dataTrans[] = array(
                                        'id' => $id,
                                        'lang_code' => strtolower($lang),
                                        'input_type' => '',
                                        'code' => $tranItemKey,
                                        'text' => $tranItemValue,
                                        'translate_type' => $typeTranslate,
                                        'created_at' => now(),
                                        'is_deleted' => 0
                                    );
                                } else {
                                    if (is_array($tranItemValue) && !empty($tranItemValue)) {
                                        foreach ($tranItemValue as $inputTypeKey => $inputValueMss) {
                                            if (!is_array($inputValueMss)) {
                                                $id++;
                                                $dataTrans[] = array(
                                                    'id' => $id,
                                                    'lang_code' => strtolower($lang),
                                                    'input_type' => $inputTypeKey,
                                                    'code' => $tranItemKey,
                                                    'text' => $inputValueMss,
                                                    'translate_type_code' => $typeTranslate,
                                                    'created_at' => now(),
                                                    'is_deleted' => 0
                                                );
                                            }

                                        }
                                    }

                                }

                            }
                        }
                        if (!empty($dataTrans)) {
                            DEVDB::table('sys_translation')->insert($dataTrans);
                        }
                    }
                }
            }
        }
    }
    public function deleteTranslate($code)
    {
        $arr = DEVDB::table("sys_translation")->where("code",$code)->delete();
    }
    public function updateTranslateText($id, $transText)
    {
        DEVDB::execSPsToDataResultCollection("DEBUG_TRANSLATE_UPDATE_TEXT_ACT", array($id, $transText));
    }

    public function insertTranslationItem($transType, $transInputType, $transTextCode, $textTrans)
    {
        return DEVDB::execSPsToDataResultCollection("DEBUG_TRANSLATE_INSERT_NEW_TEXT_ACT", array($transType, $transInputType, $transTextCode, $textTrans));
    }
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
}
