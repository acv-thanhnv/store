<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 8/3/2018
 * Time: 10:44 AM
 */

namespace App\Backend\Services\Production;

use App\Backend\Services\Interfaces\MenuServiceInterface;
use App\Core\Common\SDBStatusCode;
use App\Core\Dao\SDB;
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
    	$arrMenu = SDB::table("store_menu")
    				->where("store_id",$idStore)
                    ->orderby("priority","desc")
                    ->orderby("id","desc")
    				->get();
    	return $arrMenu;
    }
    public function addMenu($obj)
    {
        SDB::table("store_menu")->insert($obj);
    }
    public function getById($id)
    {
        $obj = SDB::table("store_menu")->where("id",$id)->get();
        return $obj[0];
    }
    public function editMenu($obj)
    {
        SDB::table("store_menu")->where("id",$obj->id)->update(["name" => $obj->name,"description"=> $obj->description]);
    }
    public function deleteMenu($id)
    {
        SDB::table("store_menu")->where("id",$id)->delete();
    } 
    public function deleteAllMenu($arrId)
    {
        foreach($arrId as $obj){
            SDB::table("store_menu")->where("id",$obj)->delete();
        }
    }
}
