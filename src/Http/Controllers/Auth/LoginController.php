<?php

namespace wh1110000\CmsL8\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use wh1110000\CmsL8\Http\Controllers\Admin\Controller;

/**
 * Class LoginController
 * @package Workhouse\Administrators\Controllers\Auth
 */

class LoginController extends Controller {

    use AuthenticatesUsers;

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function showLoginForm() {

		return view('admin.auth::login');
	}

	/**
	 * @return string
	 */

	protected function redirectTo() {

		return route('admin.dashboard.index');
	}

	/**
	 * @return \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
	 */

	protected function guard(){

		return Auth::guard('administrator');
	}
}