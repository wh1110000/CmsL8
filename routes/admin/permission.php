<?php

Route::as('permission.')->group(function () {

	Route::prefix('permissions')->group(function () {

		Route::match(['get', 'post'], '/{guard?}', [
			'uses' => 'PermissionController@index',
			'as'   => 'index',
		]);
	});

	Route::prefix('permission')->group( function () {

		Route::get('/{guard?}/{permission?}', [
			'uses' => 'PermissionController@show',
			'as'   => 'show',
		] );

		Route::put('/{guard?}/{permission?}', [
			'uses' => 'PermissionController@store',
			'as'   => 'save',
		]);

		Route::delete('/{guard?}/{permission}', [
			'uses' => 'PermissionController@destroy',
			'as'   => 'delete',
		]);
	});
});