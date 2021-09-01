<?php

namespace wh1110000\CmsL8\Http\Controllers\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use wh1110000\CmsL8\Http\Controllers\Admin\Controller;

/**
 * Class ConfirmPasswordController
 * @package Workhouse\Administrators\Controllers\Auth
 */

class ConfirmPasswordController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Confirm Password Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password confirmations and
	| uses a simple trait to include the behavior. You're free to explore
	| this trait and override any functions that require customization.
	|
	*/

	use ConfirmsPasswords;

	/**
	 * Where to redirect users when the intended url fails.
	 *
	 * @var string
	 */
	protected $redirectTo = RouteServiceProvider::HOME;

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function showLoginForm() {

		return view('admin.auth::confirm');
	}
}