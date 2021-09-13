<?php

namespace wh1110000\CmsL8\Providers;

use Illuminate\Support\Facades\Route;
use Symfony\Component\Finder\Finder;

/**
 * Class AdministratorsServiceProvider
 * @package Workhouse\Administrators\Providers
 */

class AuthServiceProvider extends AbstractServiceProvider {

	/**
	 *
	 */

	public function loadRoutes(){

		parent::loadRoutes();

		//Route::middleware(['web'])
		Route::middleware(['web'])
		     ->namespace($this->namespace.'\Http\Controllers\Auth')
		     //->prefix('admin')
		     ->prefix(self::getLocalePrefix('admin'))
		     ->as('admin.auth.')
		     ->group($this->dir('/routes/auth/auth.php'));
	}

	/**
	 *
	 */

	public function loadViews(){

		$views = Finder::create()->in($this->dir('/resources/views/auth/'))->name('*.php');

		foreach($views as $view){

			$this->loadViewsFrom($view->getPath(), 'admin.auth');
		}
	}

	/**
	 *
	 */

	public function loadConfigs(){

		parent::loadConfigs();

		$this->mergeConfigFrom($this->dir('/config/auth/guards/administrator.php'), 'auth.guards.administrator' );

		$this->mergeConfigFrom($this->dir('/config/auth/passwords/administrators.php'), 'auth.passwords.administrators' );

		$this->mergeConfigFrom($this->dir('/config/auth/providers/administrators.php'), 'auth.providers.administrators' );
    }
	/**
	 *
	 */

	/*public function loadMiddlewares() {

		$this->app['router']->pushMiddlewareToGroup('web', Authenticate::class);

		$this->app['router']->pushMiddlewareToGroup('web', RedirectIfAuthenticated::class);
	}*/
}
