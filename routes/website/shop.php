<?php

Route::as('shop.')->group(function() {

	$package = 'shop';

	$prefix = \wh1110000\CmsL8\Services\Route::getWebRouteSlubByName($package, 'categories');

	Route::prefix($prefix)->group(function() {

		Route::get('/', [
			'uses' => 'ShopCategoryController@indexCategories',
			'as'   => 'categories'
		]);
	});

	if($prefix = \wh1110000\CmsL8\Services\Route::getWebRouteSlubByName($package, 'map')){

		Route::prefix($prefix)->group(function() {

			Route::get('/', [
				'uses' => 'ShopController@map',
				'as'   => 'map'
			]);
		});
	}

	if($prefix = \wh1110000\CmsL8\Services\Route::getWebRouteSlubByName($package, 'category')){

		Route::prefix($prefix)->group(function() {

			Route::get('/{shopCategory}', [
				'uses' => 'ShopCategoryController@showCategory',
				'as'   => 'category'
			]);
		});
	}

	if($prefix = \wh1110000\CmsL8\Services\Route::getWebRouteSlubByName($package, 'shop')){

		Route::prefix($prefix)->group(function() {

			Route::get('/{shop}', [
				'uses' => 'ShopController@shopShow',
				'as'   => 'show'
			]);
		});
	}
});
