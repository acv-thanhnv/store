<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 8/3/2018
 * Time: 10:59 AM
 */

namespace App\Dev\Http\Controllers;

use App\Core\Common\SDBStatusCode;
use App\Dev\Helpers\ResponseHelper;
use App\Dev\Services\Interfaces\TranslateServiceInterface;
use Validator;
use Illuminate\Http\Request;
use App\Dev\Entities\DataResultCollection;

class TranslationController
{
    protected $service;
    public function __construct(TranslateServiceInterface $translateService)
    {
        $this->service = $translateService;
    }

    public function translationManagement()
    {
        //form CRUD translate text
        $langListFromDB = $this->service->getLanguageCodeList();
        $dataTransFromDB = $this->service->getTranslateList('', '');
        $langList = ($langListFromDB->status == SDBStatusCode::OK)?$langListFromDB->data:array();
        $dataTrans = ($dataTransFromDB->status == SDBStatusCode::OK)?$dataTransFromDB->data:array();
        $dataComboFilter = $this->service->getNewTransComboList();
        return view("dev/translation", compact(['dataTrans', 'langList', 'dataComboFilter']));
    }
    public function createNewTranslationItem(Request $request)
    {
        $validator =
            Validator::make($request->all(), [
                'text_code' => 'required'
            ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            $dataResult = new DataResultCollection();
            $dataResult->status = SDBStatusCode::WebError;
            $dataResult->data = $error;
            return ResponseHelper::JsonDataResult($dataResult);

        } else {
            $transType = $request->input('trans_type');
            $transInputType = $request->input('trans_input_type');
            $transTextCode = $request->input('text_code');
            $textTrans = $request->input('text_trans');
            $dataFromDB = $this->service->insertTranslationItem($transType, $transInputType, $transTextCode, $textTrans);
            return ResponseHelper::JsonDataResult($dataFromDB);
        }
    }
    public function deleteTranslate(Request $request)
    {
        $code = $request->code;
        $this->service->deleteTranslate($code);
    }
    public function updateTranslate(Request $request)
    {
        $id = $request->input('id');
        $transText = $request->input('text');
        $this->service->updateTranslateText($id, $transText);
        return null;
    }

    public function newTextTrans()
    {
        $langListFromDB = $this->service->getLanguageCodeList();
        $langList = ($langListFromDB->status == SDBStatusCode::OK)?$langListFromDB->data:array();
        $comboList = $this->service->getNewTransComboList();
        return view("dev/addtranslate", compact(['langList', 'comboList']))->renderSections()['content'];
    }
    public function generationLanguageFiles()
    {
        $this->service->generationTranslateFileAndScript();
    }
    public function importTranslateToDB()
    {
        $this->service->generationTransDataToDB();
    }
}
