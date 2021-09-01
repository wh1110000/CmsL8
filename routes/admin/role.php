<?php

Route::as('role.')->group(function () {

	Route::prefix('roles')->group(function () {

		Route::match(['get', 'post'], '/{guard?}', [
			'uses' => 'RoleController@index',
			'as'   => 'index',
		]);
	});

	Route::prefix('role')->group(function () {

		Route::get('/{guard?}/{role?}', [
			'uses' => 'RoleController@show',
			'as'   => 'show',
		]);

		Route::put('/{guard?}/{role?}', [
			'uses' => 'RoleController@store',
			'as'   => 'save',
		]);

		Route::delete('/{guard?}/{role}', [
			'uses' => 'RoleController@destroy',
			'as'   => 'delete',
		]);
	});
});