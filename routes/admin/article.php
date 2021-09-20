<?php

foreach(\wh1110000\CmsL8\Providers\ArchivesServiceProvider::getArchives() as $plural => $model){


	$singular = strtolower(app('DoctrineInflector')->singularize($plural));

	$plural = strtolower($plural);

	Route::as($singular.'.')->group(function() use ($plural, $singular) {

		Route::prefix($plural)->group(function() {

			Route::match(['get', 'post'], '/', [
				'uses' => 'ArchiveController@index',
				'as'   => 'index'
			]);
		});

		Route::prefix(($plural == $singular ? 'show-' : '').$singular)->group(function() {

			Route::get('/{Archive?}', [
				'uses' => 'ArchiveController@show',
				'as'   => 'show'
			]);

			Route::put('/{Archive?}', [
				'uses' => 'ArchiveController@store',
				'as'   => 'save'
			]);

			Route::delete('/{Archive}', [
				'uses' => 'ArchiveController@destroy',
				'as'   => 'destroy'
			]);
		});
	});

	Route::as($singular.'-category.')->group(function() use ($singular) {

		Route::prefix( $singular.'-categories' )->group(function() {

			Route::match(['get', 'post'], '/', [
				'uses' => 'ArchiveCategoryController@index',
				'as'   => 'index'
			]);
		});

		Route::prefix( $singular.'-category' )->group(function() {

			Route::get('/{category?}', [
				'uses' => 'ArchiveCategoryController@show',
				'as'   => 'show'
			]);

			Route::put('/{category?}', [
				'uses' => 'ArchiveCategoryController@store',
				'as'   => 'save'
			]);

			Route::delete('/{category}', [
				'uses' => 'ArchiveCategoryController@destroy',
				'as'   => 'destroy'
			]);
		});
	});
}
