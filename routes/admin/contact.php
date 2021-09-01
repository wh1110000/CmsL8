<?php

Route::as('email.')->group(function() {

	Route::prefix('contact')->group(function() {

		$allowedTypes = 'inbox|trash|important';

		Route::get('/', [
			'uses' => 'EmailController@index',
			'as' => 'index',
		])->where('type', $allowedTypes);

		Route::get('/{email}', [
			'uses' => 'EmailController@show',
			'as' => 'show',
		])->where('type', $allowedTypes);

		Route::delete('/{email}', [
			'uses' => 'EmailController@destroy',
			'as'   => 'destroy'
		])->where('type', $allowedTypes);
	});
});
