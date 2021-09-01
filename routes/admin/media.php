<?php

Route::as('media.')->group(function() {

	Route::prefix('media')->group(function() {

		Route::get('/', [
			'uses' => 'MediaController@index',
			'as' => 'index',
		]);

		Route::get('/show', [
			'uses' => 'MediaController@show',
			'as' => 'show',
		]);

		Route::post('/upload-files', [
			'uses' => 'MediaController@upload',
			'as' => 'upload-files',
		]);

		Route::prefix('modal')->group(function() {

			Route::post('/show', [
				'uses' => 'MediaController@showModal',
				'as'   => 'show.modal'
			]);

			Route::post('/upload', [
				'uses' => 'MediaController@uploadModal',
				'as'   => 'upload.modal'
			]);

			Route::post('/edit/{file}', [
				'uses' => 'MediaController@editModal',
				'as'   => 'edit.modal'
			]);
		});

		Route::post('/upload', [
			'uses' => 'MediaController@imageUpload',
			//'uses' => 'Controller@imageUpload',
			'as'   => 'upload'
		]);

		Route::get('/file-manager', [
			//'uses' => 'Controller@imageManager',
			'uses' => 'MediaController@imageManager',
			'as'   => 'manager'
		]);

		Route::delete('/{media}', [
			'uses' => 'MediaController@destroy',
			'as' => 'delete',
		]);
	});
});