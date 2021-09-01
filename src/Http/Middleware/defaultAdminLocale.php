<?php

namespace wh1110000\CmsL8\Http\Middleware;

use wh1110000\CmsL8\Services\Route;

/**
 * Class defaultAdminLocale
 * @package Workhouse\Multilanguage\Middleware
 */

class defaultAdminLocale extends localeRedirect {

	/**
	 * @return bool
	 */

	public function allowLanguageChecking(){

		return Route::isAdminAuthRoute() || Route::isAdminRoute();
	}

	/**
	 * @return bool|\Illuminate\Config\Repository|mixed|null
	 */

	protected function getAvailableLocales() {

		return config( 'locales.admin_locales' );
	}

	/**
	 * @return bool|\Illuminate\Config\Repository|mixed|null|string
	 */

	protected function getDefaultUrlLocale(){

		return config( 'locales.default_admin_locale' );
	}

	/**
	 * @return \Illuminate\Routing\Route|null|object|string
	 */

	protected function getLocale(){

		return $this->urlLocale;
	}
}