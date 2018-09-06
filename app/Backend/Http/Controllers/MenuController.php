<?php

namespace App\Backend\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Core\Entities\DataResultCollection;
use App\Core\Services\Interfaces\UploadServiceInterface;
use App\Backend\Services\Interfaces\MenuServiceInterface;
use App\Core\Common\SDBStatusCode;
use App\Core\Common\UploadConst;
use Illuminate\Support\Facades\Storage;
use App\Core\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use DateTime;

class MenuController
{
    protected $service;
    protected $uploadService;
    public function __construct(MenuServiceInterface $menuService,UploadServiceInterface $uploadService)
    {
        $this->service       = $menuService;
        $this->uploadService = $uploadService;
    }
	public function getMenu()
    {
        $arrMenu = $this->service->getMenu(1);
        return view("backend.menu.list",["arrMenu" => $arrMenu]);
    }
    public function getAddMenu()
    {
        return view("backend.menu.add");
    }
    public function postAddMenu(Request $request)
    {
        
    }
}