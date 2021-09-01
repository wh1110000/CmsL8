<?php

Route::as('shop-category.')->group(function() {

	Route::prefix( 'shop-categories' )->group(function() {

		Route::match(['get', 'post'], '/', [
			'uses' => 'ShopCategoryController@index',
			'as'   => 'index'
		]);
	});

	Route::prefix( 'shop-category' )->group(function() {

		Route::get('/{category?}', [
			'uses' => 'ShopCategoryController@show',
			'as'   => 'show'
		]);

		Route::put('/{category?}', [
			'uses' => 'ShopCategoryController@store',
			'as'   => 'save'
		]);

		Route::delete('/{category}', [
			'uses' => 'ShopCategoryController@destroy',
			'as'   => 'destroy'
		]);
	});
});