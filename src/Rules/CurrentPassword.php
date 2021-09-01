<?php

namespace wh1110000\CmsL8\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

/**
 * Class CurrentPassword
 * @package Workhouse\Administrators\Rules
 */

class CurrentPassword implements Rule {

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */

    public function passes($attribute, $value) {

	    return auth()->guard('administrator') && Hash::check($value, auth()->guard('administrator')->user()->password);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */

    public function message() {

        return 'The :attribute does not match.';
    }
}
