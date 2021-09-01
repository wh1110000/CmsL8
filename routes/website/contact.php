<?php

Route::as('contact.')->group(function () {

	$prefix = \wh1110000\CmsL8\Services\Route::getWebRouteSlubByName('contact', 'index');

	Route::prefix($prefix)->group(function() {

		Route::get('/', [
			'uses' => 'ContactController@index',
			'as'   => 'index'
		]);

		Route::post('/submit', [
			'uses' => 'ContactController@submit',
			'as'   => 'submit'
		]);

		Route::get('/thank-you', [
			'uses' => 'ContactController@thankYou',
			'as'   => 'thankyou'
		]);
	});
});