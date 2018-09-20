<?php
/**
 * @author thanhnv
 * Check allow insert
 */
namespace App\Core\ValidationRules ;

use App\Core\Common\RoleConst;
use App\Core\Dao\SDB;
use Illuminate\Contracts\Validation\Rule;

class RoleLevelRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $currentRoleValue;
    public function __construct($currentRoleValue)
    {
        $this->currentRoleValue = $currentRoleValue;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $count = SDB::table('sys_role_config')
            ->whereRaw('role_value = ?',[$this->currentRoleValue])
            ->whereRaw('role_value_allowed = ?',[$value]);
        return ($count > 0 || $this->currentRoleValue==RoleConst::SysAdminRole);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.not_allow_level_role');
    }
}
