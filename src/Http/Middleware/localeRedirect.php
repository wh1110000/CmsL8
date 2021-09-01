<?php

namespace wh1110000\CmsL8\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

/**
 * Class localeRedirect
 * @package Workhouse\Multilanguage\Middleware
 */

class localeRedirect {

	/**
	 * @var
	 */

	public $model = null;

	/**
	 * @var bool
	 */

	public $redirect = false;

	/**
	 * @var string
	 */

	public $locale;

	/**
	 * @var
	 */

	public $urlLocale;

	/**
	 * @var null
	 */

	public $translationBy;

	/**
	 * localeRedirect constructor.
	 *
	 * @param Request $request
	 */

	public function __construct(Request $request) {

		$this->urlLocale = $request->route('locale');

		$this->setTranslationBy();
	}

	/**
	 * @param $request
	 * @param \Closure $next
	 *
	 * @return \Illuminate\Http\RedirectResponse|mixed
	 */

	public function handle($request, \Closure $next) {

		if($this->allowLanguageChecking()){

			$this->resolveUrl($request->route()->parameter('locale'));

			if($this->redirect){

				return $this->redirect();
			}

			$request = $this->setLocale($request);
		}

		return $next($request);
	}

	/**
	 * @return bool
	 */

	public function allowLanguageChecking(){

		return true;
	}

	/**
	 * @param null $key
	 */

	public function setTranslationBy($key = null){

		$this->translationBy = $key;

		if(is_null($this->translationBy)){

			$this->translationBy = config('app.translationby');
		}

		$this->setModel();
	}

	/**
	 *
	 */

	protected function setModel(){

		if($this->translationBy !== false){

			/*$_model = '\\'.($this->translationBy == 'country' ? 'Country' : 'Language');

			$this->model = new $_model;*/
			$this->model = app('multilanguage');
		}
	}

	/**
	 * @return bool
	 */

	protected function getAvailableLocales(){

		$localeCodes = app('multilanguage')->getAll();
		//$localeCodes = getActiveLanguages([], $this->translationBy);

		return $localeCodes === false ? $localeCodes : $localeCodes->pluck('code')->toArray();
	}

	/**
	 * @return bool|\Illuminate\Config\Repository|mixed|null
	 */

	protected function getDefaultUrlLocale(){

		return $this->translationBy == 'country' ? config( 'locales.default_country' ) : config( 'locales.default_locale' );
	}

	/**
	 * @param $request
	 *
	 * @return mixed
	 */

	protected function setLocale($request){

		app()->setlocale($this->getLocale());

		if(in_array('locale', $request->route()->parameterNames())){

			URL::defaults([
				'locale' => $this->urlLocale
			]);

			$request->urlLocale = $this->urlLocale;

			$request->route()->forgetParameter('locale');
		}

		return $request;
	}

	/**
	 * @return bool|\Illuminate\Config\Repository|mixed|null
	 */

	protected function getLocale(){

		$locale = null;

		if($this->locale){

			$locale = $this->locale;

		} elseif($this->model){

			$locale =  $this->model->getActiveLanguage();
		}

		return $locale ?: config( 'locales.default_locale' );
	}

	/**
	 * @param null $countryCode
	 *
	 * @return mixed
	 */

	protected function resolveUrl( $countryCode = null ){

		$localeCodes = $this->getAvailableLocales();

		if($countryCode){

			$this->urlLocale = strtolower($countryCode);
		}

		if(is_array($localeCodes) && !in_array( $this->urlLocale, $localeCodes )  ){

			$this->redirect = true;

			return $this->resolveUrl($this->getDefaultUrlLocale());
		}
	}

	/**
	 * @return string
	 */

	protected function resolveUrlFromCountry($countryCode = null){

		if($countryCode){

			$this->model = $this->model->where('alpha2_code', $countryCode);
		}

		$model = $this->model->getAll()->first();

		$locale = $this->translationBy == 'country' ?  $model->getCode() : $model->language->getCode();

		return $locale;
	}

	/**
	 * @return \Illuminate\Http\RedirectResponse
	 */

	protected function redirect(){

		return redirect()->route(\Route::currentRouteName(), array_merge(\Route::current()->parameters ?? [], ['locale' => $this->urlLocale]));
	}
}