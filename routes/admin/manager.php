<?php

Route::prefix('language-manager')->group(function() {
	Route::get( 'view/{groupKey?}', 'ManagerController@getView' )->where( 'groupKey', '.*' );
	Route::get( '/{groupKey?}', 'ManagerController@getIndex' )->where( 'groupKey', '.*' );
	Route::post( '/add/{groupKey}', 'ManagerController@postAdd' )->where( 'groupKey', '.*' );
	Route::post( '/edit/{groupKey}', 'ManagerController@postEdit' )->where( 'groupKey', '.*' );
	Route::post( '/groups/add', 'ManagerController@postAddGroup' );
	Route::post( '/delete/{groupKey}/{translationKey}', 'ManagerController@postDelete' )->where( 'groupKey', '.*' );
	Route::post( '/import', 'ManagerController@postImport' );
	Route::post( '/find', 'ManagerController@postFind' );
	Route::post( '/locales/add', 'ManagerController@postAddLocale' );
	Route::post( '/locales/remove', 'ManagerController@postRemoveLocale' );
	Route::post( '/publish/{groupKey}', 'ManagerController@postPublish' )->where( 'groupKey', '.*' );
	Route::post( '/translate-missing', 'ManagerController@postTranslateMissing' );
});
