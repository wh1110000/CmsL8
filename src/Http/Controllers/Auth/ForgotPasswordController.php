<?php

namespace wh1110000\CmsL8\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use wh1110000\CmsL8\Http\Controllers\Admin\Controller;

/**
 * Class ForgotPasswordController
 * @package Workhouse\Administrators\Controllers\Auth
 */

class ForgotPasswordController extends Controller {

    use SendsPasswordResetEmails;

	/**
	 * @return mixed
	 */

	public function broker() {

		return Password::broker('administrators');
	}
}