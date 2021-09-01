<?php

namespace wh1110000\CmsL8\Models\Presenters;

/**
 * Class Setting
 * @package Workhouse\Settings\Presenters
 */

class Setting extends \wh1110000\CmsL8\Models\Setting {

	/**
	 * @var array
	 */

	public $tabsOrder = [
		'basic',
		'language',
		'analytics',
		'auth',
		'files'
	];

	/**
	 * @var array
	 */

	protected $casts = [
		'LOGO' => 'media',
		'LOGO_DARK' => 'media',
		'ALLOW_LOGIN' => 'boolean',
		'ALLOW_REGISTRATION' => 'boolean',
		'ACCEPT_TERMS_AND_CONDITIONS_ON_FIRST_TIME_LOGIN' => 'boolean',
		'SHOW_TERMS_AND_CONDITIONS_MODAL' => 'boolean',
		'SHOW_WELCOME_MODAL' => 'boolean',
		'BUY_ONLINE_BLOCK_IMAGE' => 'media',
		'DOWNLOAD_IMAGE' => 'media',
		'PDF' => 'media',
		'LOOKBOOK' => 'media',
		'BRAND_LOGO' => 'media'
	];

	/**
	 * @return array
	 */

	public function basicTab(){

		return \Row::init()
			->addCol( 6 )
			->addSection( __( 'Website' ) )
			->addField( \Fields::text( 'settings[WEBSITE_TITLE]', __('settings::fields.website_title'))->value(app('SettingsManager')->get('WEBSITE_TITLE'))->add() )
			->addCol( 6 )
			->addSection( __( 'Images' ) )
			->addField( \Fields::file( 'settings[LOGO]', __('settings::fields.logo'))->value(app('SettingsManager')->get('LOGO'))->add() )
			->addField( \Fields::file( 'settings[LOGO_DARK]', __('settings::fields.logo_dark'))->value(app('SettingsManager')->get('LOGO_DARK'))->add() )
			->addField( \Fields::file( 'settings[FAVICON]', __('settings::fields.favicon'))->value(app('SettingsManager')->get('FAVICON'))->add());
	}

	/**
	 * @return array
	 */

	public function authTab(){

		if(class_exists('Workhouse\Users\Admin\UsersController')) {

			return \Row::init()
				->addCol( 6 )
				->addSection( __( 'Login' ) )
				->addField( \Fields::bool( 'settings[ALLOW_LOGIN]', __('settings::fields.allow_login'))->selected(app('SettingsManager')->get('ALLOW_LOGIN'))->add() )
				->addField( \Fields::bool( 'settings[SHOW_TERMS_AND_CONDITIONS_MODAL]', __('settings::fields.show_terms_and_conditions_modal'))->selected(app('SettingsManager')->get('SHOW_TERMS_AND_CONDITIONS_MODAL'))->add() )
				->addField( \Fields::bool( 'settings[SHOW_WELCOME_MODAL]', __('settings::fields.show_welcome_modal'))->selected(app('SettingsManager')->get('SHOW_WELCOME_MODAL'))->add() )
				->addCol( 6 )
				->addSection( __( 'Register' ) )
				->addField( \Fields::bool( 'settings[ALLOW_REGISTRATION]', __('settings::fields.allow_registration'))->selected(app('SettingsManager')->get('ALLOW_REGISTRATION'))->add() )
				->addField( \Fields::text( 'settings[REGISTRATION_TOKEN]', __('settings::fields.registration_code'))->selected(app('SettingsManager')->get('REGISTRATION_TOKEN'))->add() );
		}
	}

	/**
	 * @return array
	 */

	public function analyticsTab(){

		return \Row::init()
			->addCol(6)
			->addSection(__('Analytics'))
			->addField(\Fields::text('settings[GOOGLE_TAG_ID]', __('settings::fields.google_tag_id'))->value(app('SettingsManager')->get('GOOGLE_TAG_ID'))->add() )
			->addField(\Fields::textarea('settings[GOOGLE_CODE]', __('settings::fields.google_code'))->value(app('SettingsManager')->get('GOOGLE_CODE'))->add() );
	}

	/**
	 * @return array
	 */

	public function CMSTab(){

		return \Row::init()
			->addCol(6)
			->addSection(__('CMS'))
			->addField(\Fields::file('settings[BRAND_LOGO]', __('settings::fields.brand_logo'))->value(app('SettingsManager')->get('BRAND_LOGO'))->add());
	}

	/**
	 * @return array
	 */

	public function ApiKeysTab(){

		return \Row::init()
			->addCol(6)
			->addSection(__('Google'))
			->addField(\Fields::text('settings[GOOGLEMAPS_API_KEY]', __('settings::fields.google_maps_api_key'))->value(app('SettingsManager')->get('GOOGLEMAPS_API_KEY'))->add());
	}
}