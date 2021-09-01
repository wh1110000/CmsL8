<?php

namespace wh1110000\CmsL8\Http\Middleware;

use Illuminate\Support\Str;
use wh1110000\CmsL8\Services\Route;
use Illuminate\Support\Facades\URL;

/**
 * Class hasAccess
 * @package Workhouse\Permissions\Middleware
 */

class Guard {

	/**
	 * @param $request
	 * @param \Closure $next
	 *
	 * @return \Illuminate\Http\RedirectResponse|mixed
	 */

	public function handle($request, \Closure $next) {

		if(Route::isAdminRoute()){

			if(auth()->guard('administrator')->check()) {

				if (Str::startsWith(Route::getCurrentRouteName(), [ 'admin.role', 'admin.permission' ] ) ) {

					if(!$request->guard || !in_array($request->guard, array_keys(config('auth.guards')))){

						URL::defaults(['guard' => 'administrator']);
					}
				}
			}
		}

		return $next($request);
	}
}
