<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 6/14/2018
 * Time: 10:23 AM
 */
namespace App\Dev\Services\Interfaces;
use App\Dev\Entities\DataResultCollection;

interface TranslateServiceInterface
{
    public function getLanguageCodeList():DataResultCollection;
    public function getTranslateMessageArray( $translateType);
    public function getTranslateList($translateType,$lang):DataResultCollection;
    public function generationTranslateFileAndScript();
    public function generationTranslateFile( $translateType, $fileName);
    public function generationTranslateScript( $fileName);
    public function generationTransDataToDB();
    public function getNewTransComboList();
    public function deleteTranslate($code);
    public function updateTranslateText($id,$transText);
    public function insertTranslationItem($transType,$transInputType,$transTextCode,$textTrans);
}
