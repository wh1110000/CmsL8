<?php

namespace wh1110000\CmsL8\Providers;

use Illuminate\Support\Facades\Blade;
use wh1110000\CmsL8\Http\Middleware\defaultAdminLocale;
use wh1110000\CmsL8\Http\Middleware\disableMultilanguage;
use wh1110000\CmsL8\Http\Middleware\geoIP;
use wh1110000\CmsL8\Http\Middleware\defaultLocale;
use wh1110000\CmsL8\Services\Translate;
use wh1110000\CmsL8\View\Components\LanguageSelector;

/**
 * Class MultilanguageServiceProvider
 * @package Workhouse\Multilanguage\Providers
 */

class MultilanguageServiceProvider extends AbstractServiceProvider {

	/**
	 *
	 */

	public function boot() {

		parent::boot();

		Blade::component('languageSelector', LanguageSelector::class);
	}

	/**
	 * @return mixed|void
	 */

	public function loadConfigs() {

		parent::loadConfigs();

		$this->mergeConfigFrom( $this->dir.'/config/geoip.php', 'geoip');

	}

	/**
	 *
	 */

	public function loadMiddlewares(){

		if(config('app.translationby')){

			if ( config( 'geoip.enabled' )) {

				$this->app['router']->pushMiddlewareToGroup('web', geoIP::class);

			} else {

				$this->app['router']->pushMiddlewareToGroup('web', defaultLocale::class);
			}

		} else {

			$this->app['router']->pushMiddlewareToGroup('web', disableMultilanguage::class);
		}

		$this->app['router']->pushMiddlewareToGroup('web', defaultAdminLocale::class);
	}

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */

	public function register() {

		parent::register();

		$this->app->singleton('translation-manager', function ($app) {

			$manager = $app->make('Barryvdh\TranslationManager\Manager');

			return $manager;
		});


		$this->app->singleton('multilanguage', Translate::class);

	}

	public function loadViews() {

		parent::loadViews();

		$this->loadViewsFrom( __DIR__ . '/../../resources/views/components/language-selector/', 'languageSelector' );
	}

}
