<?php

namespace wh1110000\CmsL8\Http\Middleware;

use wh1110000\CmsL8\Services\Route;

/**
 * Class disableMultilanguage
 * @package Workhouse\Multilanguage\Middleware
 */

class disableMultilanguage extends localeRedirect {

	/**
	 * @param $request
	 * @param \Closure $next
	 *
	 * @return \Illuminate\Http\RedirectResponse|mixed
	 */

    public function handle($request, \Closure $next) {

    	$this->setTranslationBy(false);

	    return parent::handle($request, $next);
    }

	/**
	 * @return bool
	 */

	public function allowLanguageChecking(){

		return Route::isWebRoute();
	}

	/**
	 * @return bool|\Illuminate\Config\Repository|mixed|null|string
	 */

	protected function getDefaultUrlLocale(){

		return config( 'locales.default_locale' );
	}

	/**
	 * @return \Illuminate\Routing\Route|null|object|string
	 */

	protected function getLocale(){

		return $this->getDefaultUrlLocale();
	}
}