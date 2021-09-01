<?php

Route::as('contact.')->group(function () {

	$prefix = \Workhouse\Core\Services\Route::getWebRouteSlubByName('contact', 'index');

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