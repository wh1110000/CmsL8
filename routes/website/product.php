<?php

$package = 'product';

Route::as('product.')->group(function() use ($package) {

	$prefix = \Workhouse\Core\Services\Route::getWebRouteSlubByName($package, 'index');


	Route::prefix($prefix)->group(function() {

		Route::get('/', [
			'uses' => 'ProductController@index',
			'as'   => 'index'
		]);
	});

	$prefix = \Workhouse\Core\Services\Route::getWebRouteSlubByName($package, 'product');

	Route::prefix($prefix)->group(function() {

		Route::get('/{product}', [
			'uses' => 'ProductController@show',
			'as'   => 'show'
		]);
	});
});
