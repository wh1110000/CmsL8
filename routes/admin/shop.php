<?php

Route::as('shop.')->group(function() {

	Route::prefix('shops')->group(function() {

		Route::match(['get', 'post'], '/', [
			'uses' => 'ShopController@index',
			'as' => 'index'
		]);
	});

	Route::prefix('shop')->group(function() {

		Route::as('tab.')->group(function() {

			Route::get('/details/{shop?}', [
				'uses' => 'ShopController@showDetailsTab',
				'as'   => 'details'
			]);

			Route::get('/opening_hours/{shop}', [
				'uses' => 'ShopController@showOpeningHoursTab',
				'as'   => 'opening_hours'
			]);

			Route::get('/testimonials/{shop}', [
				'uses' => 'ShopController@showTestimonialsTab',
				'as'   => 'testimonials'
			]);
		});

		Route::get('/getList/{shop}/testimonials', [
			'uses' => 'ShopController@getTestimonialList',
			'as'   => 'get_list_testimonials',
		]);

		Route::get('/details/{shop?}', [
			'uses' => 'ShopController@showDetailsTab',
			'as'   => 'show'
		]);

		Route::put('/{shop?}', [
			'uses' => 'ShopController@store',
			'as' => 'save'
		]);

		Route::delete('/{shop}', [
			'uses' => 'ShopController@destroy',
			'as' => 'destroy'
		]);

		Route::delete('/{shop}/{day}', [
			'uses' => 'ShopController@destroyOpeningHours',
			'as' => 'delete.opening_times'
		]);
	});

	Route::prefix('modal')->as('modal.')->group(function() {

		Route::post('/weekdays/{shop}', [
			'uses' => 'ShopController@showWeekdaysModal',
			'as'   => 'weekdays'
		]);

		Route::post('/bankholidays/{shop}/{day?}', [
			'uses' => 'ShopController@showBankholidaysModal',
			'as'   => 'bankholidays'
		]);
	});

});