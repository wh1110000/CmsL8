<?php

Route::as('shop.')->group(function() {

	$package = 'shop';

	$prefix = \Workhouse\Core\Services\Route::getWebRouteSlubByName($package, 'categories');

	Route::prefix($prefix)->group(function() {

		Route::get('/', [
			'uses' => 'ShopCategoryController@indexCategories',
			'as'   => 'categories'
		]);
	});

	if($prefix = \Workhouse\Core\Services\Route::getWebRouteSlubByName($package, 'map')){

		Route::prefix($prefix)->group(function() {

			Route::get('/', [
				'uses' => 'ShopController@map',
				'as'   => 'map'
			]);
		});
	}

	if($prefix = \Workhouse\Core\Services\Route::getWebRouteSlubByName($package, 'category')){

		Route::prefix($prefix)->group(function() {

			Route::get('/{shopCategory}', [
				'uses' => 'ShopCategoryController@showCategory',
				'as'   => 'category'
			]);
		});
	}

	if($prefix = \Workhouse\Core\Services\Route::getWebRouteSlubByName($package, 'shop')){

		Route::prefix($prefix)->group(function() {

			Route::get('/{shop}', [
				'uses' => 'ShopController@shopShow',
				'as'   => 'show'
			]);
		});
	}
});
