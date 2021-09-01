<?php

namespace wh1110000\CmsL8\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use wh1110000\CmsL8\Http\Controllers\Admin\Controller;

/**
 * Class ResetPasswordController
 * @package Workhouse\Administrators\Controllers\Auth
 */

class ResetPasswordController extends Controller {

    use ResetsPasswords;

	/**
	 * @param Request $request
	 * @param null $token
	 *
	 * @return $this
	 */

	public function showResetForm(Request $request, $token = null) {

		return view('admin.auth::passwords.reset')->with(['token' => $token, 'email' => $request->email]);
	}

	/**
	 * @return \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
	 */

	protected function guard() {

		return Auth::guard('administrator');
	}

	/**
	 * @return mixed
	 */

	public function broker() {

		return Password::broker('administrators');
	}

	/**
	 * @return string
	 */

	public function redirectTo(){

		return route('admin.dashboard.index');
	}
}