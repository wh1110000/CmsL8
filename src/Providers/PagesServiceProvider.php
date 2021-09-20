<?php

namespace wh1110000\CmsL8\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Finder\Finder;
use wh1110000\CmsL8\Http\Middleware\SetRouteAttributes;

/**
 * Class MediaServiceProvider
 * @package Workhouse\Pages\Providers
 */

class PagesServiceProvider extends AbstractServiceProvider {

	public function loadMiddlewares() {

		$this->app['router']->pushMiddlewareToGroup('web', SetRouteAttributes::class);

	}

	public static function getPageRoute(){

		$reflector = new \ReflectionClass(get_called_class());

		$namespace = Str::beforeLast($reflector->getNamespaceName(), '\\Providers');

		Route::middleware( [ 'web', /*'auth:web'*/ ] )
		    ->namespace( '\\'.$namespace.'\Http\Controllers\Website' )
		    ->prefix( self::getLocalePrefix() )
			->group(function() {

				Route::as( 'page.' )->group( function () {

					Route::match( [ 'GET' ], '/{page}', [
						'uses' => 'PageController@show',
						'as'   => 'show'
					] );
				} );

				Route::fallback( 'PageController@fallback' );
			});
	}
}
