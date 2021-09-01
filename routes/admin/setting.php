<?php

Route::as('setting.')->group(function() {

	Route::prefix('settings')->group(function() {

		Route::get('/', [
			'uses' => 'SettingController@show',
			'as'   => 'show'
		]);

		Route::put('/save', [
			'uses' => 'SettingController@store',
			'as'   => 'save'
		]);
	});
});