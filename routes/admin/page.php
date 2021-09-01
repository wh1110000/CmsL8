<?php

Route::as('page.')->group(function() {

	Route::prefix('pages')->group(function() {

		Route::match(['get', 'post'], '/', [
			'uses' => 'PageController@index',
			'as' => 'index',
		]);
	});

	// Single page Routes...

	Route::prefix('page')->group(function() {

		Route::get('/{page?}', [
			'uses' => 'PageController@show',
			'as' => 'show',
		]);

		Route::put('/{page?}', [
			'uses' => 'PageController@store',
			'as' => 'save',
		]);

		Route::delete('/{page}', [
			'uses' => 'PageController@destroy',
			'as'   => 'destroy'
		]);
	});
});
