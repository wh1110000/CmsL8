<?php

/*foreach(\Workhouse\Articles\Providers\ArticlesServiceProvider::getArchives() as $plural => $model){

	$singular = app('DoctrineInflector')->singularize($plural);

	Route::as($singular.'.')->group(function() use ($plural, $singular) {

		Route::prefix($plural)->group(function() {

			Route::match(['get', 'post'], '/', [
				'uses' => 'ArticleController@index',
				'as'   => 'index'
			]);
		});

		Route::prefix(($plural == $singular ? 'show-' : '').$singular)->group(function() {

			Route::get('/{article?}', [
				'uses' => 'ArticleController@show',
				'as'   => 'show'
			]);

			Route::put('/{article?}', [
				'uses' => 'ArticleController@store',
				'as'   => 'save'
			]);

			Route::delete('/{article}', [
				'uses' => 'ArticleController@destroy',
				'as'   => 'destroy'
			]);
		});
	});

	Route::as($singular.'-category.')->group(function() use ($singular) {

		Route::prefix( $singular.'-categories' )->group(function() {

			Route::match(['get', 'post'], '/', [
				'uses' => 'ArticleCategoryController@index',
				'as'   => 'index'
			]);
		});

		Route::prefix( $singular.'-category' )->group(function() {

			Route::get('/{category?}', [
				'uses' => 'ArticleCategoryController@show',
				'as'   => 'show'
			]);

			Route::put('/{category?}', [
				'uses' => 'ArticleCategoryController@store',
				'as'   => 'save'
			]);

			Route::delete('/{category}', [
				'uses' => 'ArticleCategoryController@destroy',
				'as'   => 'destroy'
			]);
		});
	});
}
*/