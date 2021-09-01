<?php

Route::as('product-category.')->group(function() {

	Route::prefix( 'product-categories' )->group(function() {

		Route::get('/', [
			'uses' => 'ProductCategoryController@index',
			'as'   => 'index'
		]);
	});

	Route::prefix( 'product-category' )->group(function() {

		Route::get('/{productCategory?}', [
			'uses' => 'ProductCategoryController@show',
			'as'   => 'show'
		]);

		Route::put('/{productCategory?}', [
			'uses' => 'ProductCategoryController@store',
			'as'   => 'save'
		]);

		Route::delete('/{productCategory}', [
			'uses' => 'ProductCategoryController@destroy',
			'as'   => 'destroy'
		]);
	});
});