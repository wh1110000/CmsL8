<?php

Route::as('dashboard.')->group(function () {

	Route::get('/', [
		'uses' => 'DashboardController@index',
		'as'   => 'index'
	]);
});