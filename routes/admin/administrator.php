<?php

Route::middleware(['auth:administrator'])->as('administrator.')->group(function () {

	Route::prefix('administrators')->group(function() {

		Route::match(['get', 'post'], '/', [
			'uses' => 'AdministratorController@index',
			'as'   => 'index'
		]);
	});

	Route::prefix('administrator')->group(function() {

		Route::get('/{administrator?}', [
			'uses' => 'AdministratorController@show',
			'as' => 'show',
		]);

		Route::put('/{administrator?}', [
			'uses' => 'AdministratorController@store',
			'as' => 'save',
		]);

		Route::delete('/{administrator}', [
			'uses' => 'AdministratorController@destroy',
			'as' => 'destroy',
		]);

		Route::post('password/email/{administrator}', [
			'uses' => 'AdministratorController@sendNewPasswordLinkEmail',
			'as'   => 'password.email'
		]);
	});
});

Route::as('account.')->group(function () {

	Route::prefix('account')->group(function () {

		Route::get( '/', [
			'uses' => 'AdministratorController@account',
			'as'   => 'index'
		]);

		Route::post( '/save', [
			'uses' => 'AdministratorController@saveAccount',
			'as'   => 'save'
		]);
	});
});