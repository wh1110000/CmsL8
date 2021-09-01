<?php

namespace wh1110000\CmsL8\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use wh1110000\CmsL8\Services\Route;

/**
 * Class logout
 * @package Workhouse\Administrators\Middleware
 */

class RedirectIfAuthenticated extends \App\Http\Middleware\RedirectIfAuthenticated {

	/**
	 * @param $request
	 * @param \Closure $next
	 *
	 * @return \Illuminate\Http\RedirectResponse|mixed
	 */

	public function handle($request, Closure $next, $guard = null) {

		/*if ( Auth::guard( $guard )->check() ) {

			if ( Route::isAdminAuthRoute() ) {

				return redirect()->route( 'admin.dashboard.index' );

			} else {

				return redirect()->route( 'homepage' );
			}
		}*/

		return $next( $request );
	}
}
