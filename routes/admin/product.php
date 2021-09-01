<?php

Route::as('product.')->group(function() {

	Route::prefix('products')->group(function() {

		Route::get('/', [
			'uses' => 'ProductController@index',
			'as'   => 'index'
		]);
	});

	Route::prefix('product')->group(function() {

		Route::get('/{product?}', [
			'uses' => 'ProductController@show',
			'as'   => 'show'
		]);

		Route::put('/{product?}', [
			'uses' => 'ProductController@store',
			'as'   => 'save'
		]);

		Route::delete('/{product}', [
			'uses' => 'ProductController@destroy',
			'as'   => 'destroy'
		]);
	});
});