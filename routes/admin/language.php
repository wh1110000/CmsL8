<?php

Route::as('language.')->group(function () {

	Route::prefix('languages')->group(function() {

		Route::match(['get', 'post'], '/', [
			'uses' => 'LanguageController@index',
			'as'   => 'index'
		]);
	});

	Route::prefix('language')->group(function() {

		Route::prefix('modal')->group(function() {

			Route::post( '/manage', [
				'uses' => 'LanguageController@showManageModal',
				'as'   => 'manage',
			] );
		});

		Route::get('/{language?}', [
			'uses' => 'LanguageController@show',
			'as' => 'show',
		]);

		Route::put('/{language?}', [
			'uses' => 'LanguageController@store',
			'as' => 'save',
		]);

		/*Route::delete('/{language}', [
			'uses' => 'LanguageController@destroy',
			'as' => 'destroy',
		]);*/
	});
});