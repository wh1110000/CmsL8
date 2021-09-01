<?php

namespace wh1110000\CmsL8\Services;

/**
 * Class Settings
 * @package Workhouse\Settings\Services
 */

class Settings {

	/**
	 * Settings constructor.
	 */

	public function __construct() {

		\Setting::get()->map(function($setting) {

			$this->settings[$setting->getKey()] = $setting->getValue();
		});
   }

	/**
	 * @param $key
	 *
	 * @return mixed
	 */

   public function get($key){

		return $this->settings[$key] ?? null;
   }
}
