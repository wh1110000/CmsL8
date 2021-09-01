<?php

Route::as('nav.')->group(function() {

	Route::prefix('nav')->group(function() {

		Route::get('/{nav?}', [
			'uses' => 'NavController@index',
			'as' => 'index',
		]);

		Route::post('/{nav?}', [
			'uses' => 'NavController@showNavModal',
			'as' => 'nav.show',
		]);

		Route::put('/reorder/{nav}', [
			'uses' => 'NavController@reorderPages',
			'as' => 'reorder',
		]);

		Route::delete('/{nav}', [
			'uses' => 'NavController@destroyNav',
			'as' => 'delete',
		]);

		Route::as('page.')->group(function() {

			Route::prefix('page')->group(function() {

				Route::post('/edit/{page?}', [
					'uses' => 'NavController@showPageModal',
					'as' => 'edit',
				]);

				Route::post('/{nav}', [
					'uses' => 'NavController@addToNavModal',
					'as' => 'addToNav',
				]);

				Route::delete('/{page}', [
					'uses' => 'NavController@destroyPage',
					'as' => 'delete',
				]);
			});
		});
	});
});