<?php

namespace App\Backend\Http\Controllers;

use App\Core\Dao\SDB;
use App\Core\Services\Interfaces\UploadServiceInterface;
use App\Core\Common\SDBStatusCode;
use App\Core\Common\UploadConst;
use App\Core\Entities\DataResultCollection;
use App\Core\Helpers\CommonHelper;
use App\Core\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Writers\LaravelExcelWriter;
use Illuminate\Support\Facades\Input;
use File;
use DB;

class TemplateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $uploadService;

    public function __construct(UploadServiceInterface $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.template.index');
    }

    public function form()
    {
        return view('backend.template.form');
    }

    public function components()
    {
        return view('backend.template.component');
    }

    public function buttons()
    {
        return view('backend.template.button');
    }

    public function upload()
    {
        $diskLocalName = 'public';
        $fileList = Storage::disk($diskLocalName)->allFiles('uploads/templates');
        $fileLocalInforList = array();
        if(!empty($fileList)){
            foreach ($fileList as $path){
                $fileLocalInforList[] = array(
                    'url'=>Storage::disk($diskLocalName)->url($path),
                    'path'=>$path
                );
            }
        }
        return view('backend.template.upload',compact('fileLocalInforList'));
    }
    public function getImageFromS3(){
        $result = new DataResultCollection();
        $result->status = SDBStatusCode::OK;
        $diskS3Name = 's3';
        $fileList = Storage::disk($diskS3Name)->allFiles('uploads/templates');
        $fileS3InforList = array();
        if(!empty($fileList)){
            foreach ($fileList as $path){
                $fileS3InforList[] = array(
                    'url'=>Storage::disk($diskS3Name)->url($path),
                    'path'=>$path
                );
            }
        }
        $result->data = $fileS3InforList;
        return ResponseHelper::JsonDataResult($result);
    }
    public function doUpload(Request $request)
    {
        $files = $request->allFiles();
        $result =  new DataResultCollection();
        $rule = [
            "*"=>$this->getImageRules(),
        ];
        $message_rule = [
            '*.mimes' => 'Mime not Allowed'
        ];
        $validator = Validator::make($request->allFiles(), $rule,$message_rule);
        if (!$validator->fails()) {
            $result = $this->uploadService->uploadFile($files,'public','uploads/templates','');
        } else {
            $error = array($validator->errors());
            $result->status = SDBStatusCode::ValidateError;
            $result->message = 'An error occured while uploading the file.';
            $result->data =$error;
        }

        return ResponseHelper::JsonDataResult($result);
    }
    public function doUploadS3(Request $request)
    {
        $files = $request->allFiles();
        $result =  new DataResultCollection();
        $rule = [
            "*"=>$this->getImageRules(),
        ];
        $message_rule = [
            '*.mimes' => 'Mime not Allowed'
        ];
        $validator = Validator::make($request->allFiles(), $rule,$message_rule);
        if (!$validator->fails()) {
            $result = $this->uploadService->uploadFile($files,'s3','uploads/templates','public');
        } else {
            $error = array($validator->errors());
            $result->status = SDBStatusCode::ValidateError;
            $result->message = 'An error occured while uploading the file.';
            $result->data =$error;
        }

        return ResponseHelper::JsonDataResult($result);
    }
    public function doDeleteFile(Request $request){
        $fileUrl =  $request->input('path');
        $result = $this->uploadService->deleteFile('public',$fileUrl);
        return ResponseHelper::JsonDataResult($result);
    }
    public function doDeleteFileS3(Request $request){
        $fileUrl =  $request->input('path');
        $result = $this->uploadService->deleteFile('s3',$fileUrl);
        return ResponseHelper::JsonDataResult($result);
    }

    public function generalElement()
    {
        return view('backend.template.generalElement');
    }

    public function icons()
    {
        return view('backend.template.icons');
    }

    public function glyphicons()
    {
        return view('backend.template.glyphicons');
    }

    public function calendar()
    {
        return view('backend.template.calendar');
    }

    public function tables()
    {
        return view('backend.template.table');
    }

    public function exports()
    {
        return view('backend.template.export');
    }

    /**
     * Register task list
     * At now not access permission to run crontab commmand
     */
    public function executeSchedule(){
        Storage::disk('public')->append('test_schedule/test.txt',"test"."\n");
        $cronTabPath =  storage_path('cronjob/task_list.txt');
        exec( 'crontab '.$cronTabPath );
    }
    /**
     * @return mixed
     * use Maatwebsite\Excel\Excel v2.0
     */
    public function doExports(){
        //import file
         Excel::load(('resources/export_templates/backend/ユーザー.xlsx'), function ($file) {
            $data = array(array('data1','data2','data3'),array('data1','data2','data3'));

             // create file name
            Excel::create('ユーザー', function ($excel) use ($data , $file) {
                $exportData = json_decode(json_encode($data), true);
                    $sheet1 = $file->setActiveSheetIndex(0);
                    //print start column F7
                    $sheet1->fromArray($exportData, null, 'F7', true);
                    $excel->addExternalSheet($sheet1);
            })->export('xlsx');
        });
    }
    public function doExportsCommon($type){
        $data = array(
            array("header1"=>'data1','header2'=>'data2','header3'=>'data3')
        ,   array("header1"=>'data4','header2'=>'data5','header3'=>'data6')
        );
        Excel::create('Translations', function($excel) use ($data) {
            $excel->sheet('Translation', function($sheet) use ($data)
            {
                $sheet->fromArray($data,null,'A1',true);
            });
        })->export($type);
    }
    public function doImport(){

        if(Input::hasFile('imported_file')){
            $path = Input::file('imported_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
                $dataArray = $reader->getActiveSheet()
                ->rangeToArray(
                    'C3:E5',     // The worksheet range that we want to retrieve
                    null,        // Value that should be returned for empty cells
                    TRUE,        // Should formulas be calculated (the equivalent of getCalculatedValue() for each cell)
                    TRUE,        // Should values be formatted (the equivalent of getFormattedValue() for each cell)
                    TRUE         // Should the array be indexed by cell row and cell column
                );
                echo '<pre>';
                print_r($dataArray);
            })->get();

        }

    }

    /**
     * Rules for image
     *
     * @return array
     */
    protected function getImageRules()
    {
        return [
            'required',
            'mimes:' . UploadConst::FILE_IMAGE_UPLOAD_ACCESSED,
            'image',
            'max:' . UploadConst::BACKEND_UPLOAD_IMAGE_MAX
        ];
    }
}
