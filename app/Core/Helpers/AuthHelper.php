<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 9/17/2018
 * Time: 1:59 PM
 */

namespace App\Core\Helpers;

use App\Core\Common\RoleConst;
use App\Core\Dao\SDB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class AuthHelper
{
    public static function IsAccess($routerName)
    {
        $roleId = RoleConst::PublicRole;
        if (Auth::check()) {
            $roleId = Auth::user()->role_value;
        }
        $moduleInfor = CommonHelper::getModuleInforByRouter($routerName);
        if (self::isAccessByRole($roleId, $moduleInfor->screenCode) == true) {
            return true;
        }
        return false;
    }

    /**
     * @param $roleId
     * @param $screenCode
     * @return bool
     * validate has role
     */
    public static function isAccessByRole($roleId, $screenCode)
    {
        $configAcl = Config::get('acl');
        //Allow user has active access or system admin role
        if ((isset($configAcl[$roleId]) && isset($configAcl[$roleId][$screenCode]) && $configAcl[$roleId][$screenCode] == 1)
            || ($roleId == RoleConst::SysAdminRole)) {
            return true;
        }
        return false;
    }
    public static function getUserInfor() {
        $detail = SDB::table('users')
            ->join('users_detail','users_detail.user_id','=','users.id')
            ->whereRaw('user_id=?',[Auth::user()->id])
            ->selectRaw('users.*,users_detail.avatar,users_detail.gender,users_detail.birth_date')
            ->get()->first() ;
        return $detail;
    }
}
