<?php
/**
 * @author thanhnv
 */
namespace App\Dev\Rules;

use Illuminate\Contracts\Validation\Rule;

class RoleLevelRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        //$currentRole =  (isset())
        return (strtoupper($value) === $value);
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
