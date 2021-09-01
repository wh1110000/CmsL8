<?php

Route::as('page.')->group(function() {

	Route::get('/', [
		'uses' => 'PageController@show',
		'as'   => 'homepage'
	] );

	/*Route::match(['GET'], '/page-{page}', [
		'uses' => 'PageController@show',
		'as'   => 'show'
	]);*/


	/*Route::get('/{page?}', [
		'uses' => 'PageController@show',
		'as'   => 'show'
	])/*->where('page', \Page::where('type', 'internal')->pluck('link')->implode('|').'|homepage|privacy-policy|terms-and-conditions')*/;
});

//*Route::fallback( 'PageController@fallback' );


/*Route::middleware(['web', 'auth:web'])->prefix(\Workhouse\Core\Providers\AbstractServiceProvider::getLocalePrefix())->namespace('Website')->group(function() {

	Route::as('page.')->group(function() {

		Route::match(['GET', 'POST', 'PATCH'], '/{page}', [
			'uses' => 'PageController@show',
			'as'   => 'show'
		]);
	});
});*/