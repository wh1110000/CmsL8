<?php

namespace wh1110000\CmsL8\Http\Middleware;

use wh1110000\CmsL8\Services\Route;

/**
 * Class defaultLocale
 * @package Workhouse\Multilanguage\Middleware
 */

class defaultLocale extends localeRedirect {

	/**
	 * @return bool
	 */

	public function allowLanguageChecking(){

		return Route::isWebRoute();
	}

	/**
	 * @return string
	 */

	protected function getDefaultUrlLocale() {

		return $this->resolveUrlFromCountry();
	}
}