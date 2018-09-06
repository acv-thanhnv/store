<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 8/3/2018
 * Time: 10:44 AM
 */

namespace App\Backend\Services\Production;

use DB;
use App\Core\Common\SDBStatusCode;
use App\Backend\Services\Interfaces\MenuServiceInterface;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
class MenuService extends BaseService implements MenuServiceInterface
{
    /**
     * @param $validateArray
     * @param $fileName
     * HELPER: Generation Config File contain text translated.
     */
    public function getMenu($idStore)
    {
    	$arrMenu = DB::table("store_menu")
    				->where("store_id",$idStore)
    				->get();
    	return $arrMenu;
    }
}
