<?php

$package = 'product';

Route::as('product.')->group(function() use ($package) {

	$prefix = \wh1110000\CmsL8\Services\Route::getWebRouteSlubByName($package, 'index');


	Route::prefix($prefix)->group(function() {

		Route::get('/', [
			'uses' => 'ProductController@index',
			'as'   => 'index'
		]);
	});

	$prefix = \wh1110000\CmsL8\Services\Route::getWebRouteSlubByName($package, 'product');

	Route::prefix($prefix)->group(function() {

		Route::get('/{product}', [
			'uses' => 'ProductController@show',
			'as'   => 'show'
		]);
	});
});
