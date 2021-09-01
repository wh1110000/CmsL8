<?php

namespace wh1110000\CmsL8\Http\Middleware;

use App\Http\Middleware\Authenticate as Middleware;
use wh1110000\CmsL8\Services\Route;

/**
 * Class auth
 * @package Workhouse\Administrators\Middleware
 */

class Authenticate extends Middleware {

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return null|string
	 */

	protected function redirectTo($request) {

		/*if (!$request->expectsJson()) {

			if(Route::isAdminRoute()){

				return route('admin.auth.login', ['en']);
			}
		}*/
	}
}
