<?php

namespace wh1110000\CmsL8\Providers;

use wh1110000\CmsL8\Providers\AbstractServiceProvider;
use wh1110000\CmsL8\Services\Settings;

/**
 * Class SettingsServiceProvider
 * @package Workhouse\Settings\Providers
 */

class SettingsServiceProvider extends AbstractServiceProvider {

	/**
	 *
	 */

	public function bootSettings() {

		parent::bootSettings();

		$this->app->singleton('SettingsManager', Settings::class);
	}
}
