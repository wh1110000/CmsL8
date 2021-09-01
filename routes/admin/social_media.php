<?php

Route::as('social-media.')->group(function () {

	Route::prefix('social-media')->group( function () {

		Route::get('/', [
			'uses' => 'SocialMediaController@index',
			'as'   => 'index',
		]);
	});

	Route::prefix('social-media-service')->group( function () {

		Route::get('/{socialMedia?}', [
			'uses' => 'SocialMediaController@show',
			'as'   => 'show',
		]);

		Route::put('/{socialMedia?}', [
			'uses' => 'SocialMediaController@store',
			'as'   => 'save',
		]);

		Route::delete('/{socialMedia}', [
			'uses' => 'SocialMediaController@destroy',
			'as'   => 'delete',
		]);
	});
});
