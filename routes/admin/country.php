<?php

Route::as('country.')->group(function () {

	Route::prefix('countries')->group(function() {

		Route::match(['get', 'post'], '/', [
			'uses' => 'CountryController@index',
			'as'   => 'index'
		]);
	});

	Route::prefix('country')->group(function() {

		Route::prefix('modal')->group(function() {

			Route::post( '/manage', [
				'uses' => 'CountryController@showManageModal',
				'as'   => 'manage',
			] );
		});

		Route::get('/{country?}', [
			'uses' => 'CountryController@show',
			'as' => 'show',
		]);

		Route::put('/{country?}', [
			'uses' => 'CountryController@store',
			'as' => 'save',
		]);
	});
});