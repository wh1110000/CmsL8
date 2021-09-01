<?php

namespace wh1110000\CmsL8\Providers;

use wh1110000\CmsL8\Http\Middleware\Cache;
use wh1110000\CmsL8\Http\Middleware\CookiePolicyDenied;
use wh1110000\CmsL8\Repositories\BaseWebRepository;
use wh1110000\CmsL8\Providers\AbstractServiceProvider;
use wh1110000\CmsL8\Services\Route;

/**
 * Class AdminServiceProvider
 * @package Workhouse\Cms
 */

class CmsServiceProvider extends AbstractServiceProvider {

	/**
	 *
	 */

	public function boot() {

		parent::boot();

		$this->bootViewComposer();
	}

	/**
	 *
	 */

	public function bootViewComposer(){

		\View::composer('*', function ($view) {

			if(Route::isWebRoute()){

				/*$repository = new BaseWebRepository();

				$view->with('page', $repository->getPage());
				$view->with('post', $repository->getPost());*/
			}
		});
	}

	/**
	 *
	 */


	/**
	 *
	 */

	//public function loadPublish(){

		/*parent::loadPublish();

		$this->publishes([
			$this->dir.'/resources/views/website/account/index.blade.php' => resource_path('views/vendor/account/index.blade.php')
		], 'account');

		$this->publishes([
			$this->dir.'/resources/views/website/account/modal' => resource_path('views/vendor/account/modal')
		], 'welcome-modal');

		$this->publishes([
			$this->dir.'/resources/views/website/auth' => resource_path('views/vendor/auth')
		], 'auth');

		$this->publishes([
			$this->dir.'/resources/views/website/contents/homepage.blade.php' => resource_path('views/vendor/contents/homepage.blade.php')
		], 'homepage');

		$this->publishes([
			$this->dir.'/resources/views/website/contents/internal.blade.php' => resource_path('views/vendor/contents/internal.blade.php')
		], 'content-internal');

		$this->publishes([
			$this->dir.'/resources/views/website/contents/global.blade.php' => resource_path('views/vendor/contents/global.blade.php'),
			$this->dir.'/resources/views/website/contents/partials/terms_and_conditions_accepted.blade.php' => resource_path('views/vendor/contents/partials/terms_and_conditions_accepted.blade.php'),
		], 'content-global');

		$this->publishes([
			$this->dir.'/resources/views/website/website.blade.php' => resource_path('views/vendor/website/website.blade.php')
		], 'website-template');

		$this->publishes([
			$this->dir.'/resources/views/website/auth.blade.php' => resource_path('views/vendor/website/auth.blade.php')
		], 'auth-template');

		$this->publishes([
			$this->dir.'/resources/lang/' => resource_path('lang/vendor/cms'),
		], 'lang');*/
	//}

	/**
	 *
	 */

	//public function loadRoutes(){



		//AUTH ADMIN

		//parent::loadRoutes();

		/*Route::middleware(['web'])
		     ->namespace($this->namespace.'\Admin\Auth')
		     ->prefix('admin')
		     ->as('admin.auth.')
		     ->group($this->dir.'/routes/admin/auth/auth.php');*/

	//}


	/**
	 *
	 */

    public function loadViews() {

		parent::loadViews();

	    $this->loadViewsFrom($this->dir('/resources/views/errors/'), 'errors');
/*	    $this->loadViewsFrom($this->dir.'/resources/views/emails/admin/template', 'emails.admin');

	    $this->loadViewsFrom($this->dir.'/resources/views/components/', 'components');


	    $this->loadViewsFrom($this->dir.'/resources/views/blocks/', 'blocks');*/
	}

	/**
	 * @return mixed|void
	 */

	public function loadMiddlewares(){

		$this->app['router']->pushMiddlewareToGroup('web', CookiePolicyDenied::class);
	}

	/**
	 *
	 */

	//public function loadBreadcrumb() {

		/*Breadcrumbs::for('page.show', function ($trail, $page = null) {

			$trail->push(  __('general.home'), route('page.homepage'));

			$page = \Page::where('link', $page)->first();

			$ancestors = [];

			while( $page ){
				$ancestors[] = $page;
				$page = $page->parent;
			}

			$ancestors = array_reverse( $ancestors );

			foreach ($ancestors as $ancestor ) {

				$trail->push($ancestor->title, route('page.show', $ancestor));
			}

		});

		Breadcrumbs::for('page.search', function ($trail, $page = null) {
			$trail->push(  __('general.home'), route('page.homepage'));
			$trail->push(  __('general.search'), route('page.search'));
		});*/
	//}
}
