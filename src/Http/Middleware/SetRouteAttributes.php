<?php

namespace wh1110000\CmsL8\Http\Middleware;

use wh1110000\CmsL8\Http\Repositories\BaseWebRepository;
use wh1110000\CmsL8\Services\Route;

/**
 * Class SetRouteAttributes
 * @package Workhouse\Cms\Middleware
 */

class SetRouteAttributes {

	/**
	 * @param $request
	 * @param \Closure $next
	 *
	 * @return mixed
	 */

	public function handle($request, \Closure $next) {

		if(Route::isAdminAuthRoute()){

		} elseif(Route::isAdminRoute()){

		} elseif(Route::isAuthRoute()) {

		} else { //Website

			//$repository = new BaseWebRepository();

			//Route::setRepository($repository->getRepository());

			//$request->attributes->add(['currentPage' => $repository->getPage()]);

			//$request->attributes->add(['currentPost' => $repository->getPost()]);
		}

		return $next($request);
	}
}
