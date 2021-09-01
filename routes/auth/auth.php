<?php

Route::group(['middleware' => ['guest:administrator']], function () {

	// Login Routes...

	Route::get( 'login', [
		'uses' => 'LoginController@showLoginForm',
		'as'   => 'login',
	] );

	Route::post( 'login', [
		'uses' => 'LoginController@login',
		'as'   => 'login.submit'
	] );

	// Password Reset Routes...

	Route::post( 'password/email', [
		'uses' => 'ForgotPasswordController@sendResetLinkEmail',
		'as'   => 'password.email'
	] );

	Route::get( 'password/reset/{token}', [
		'uses' => 'ResetPasswordController@showResetForm',
		'as'   => 'password.reset'
	] );

	Route::post( 'password/reset', [
		'uses' => 'ResetPasswordController@reset',
		'as'   => 'password.update'
	] );

	// Password Confirmation Routes...

	Route::get( 'password/confirm', [
		'uses' => 'ConfirmPasswordController@showConfirmForm',
		'as'   => 'password.confirm',
	]);

	Route::post( 'password/confirm', [
		'uses' => 'ConfirmPasswordController@confirm',
		'as'   => 'password.confirm.submit'
	]);
});

Route::group(['middleware' => 'auth:administrator'], function () {

	// Logout Routes

	Route::post( 'logout', [
		'uses' => 'LoginController@logout',
		'as'   => 'logout'
	]);
});