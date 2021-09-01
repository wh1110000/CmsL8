<?php

namespace wh1110000\CmsL8\Http\Middleware;

use wh1110000\CmsL8\Services\Route;
use wh1110000\CmsL8\View\Components\CookiePolicy;

/**
 * Class CookieDenied
 * @package Workhouse\Cms\Middleware
 */

class CookiePolicyDenied {

	/**
	 * @var string
	 */

	private $route = 'page.show';

	/**
	 * @param $request
	 * @param \Closure $next
	 *
	 * @return \Illuminate\Http\RedirectResponse|mixed
	 * @throws \Exception
	 */

	public function handle($request, \Closure $next) {

		if(Route::isWebRoute()) {

			if(CookiePolicy::isAccepted() === false){

				$slug = Route::getWebRouteSlubByName('page', 'cookie-policy');

				if(!(Route::getCurrentRouteName() == $this->route && $request->page == $slug )){

					return redirect()->route( $this->route, [app('multilanguage')->getActiveUrlLocale(), $slug]);
				}
			}
		}

		return $next($request);
	}
}
