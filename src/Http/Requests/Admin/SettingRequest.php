<?php

namespace wh1110000\CmsL8\Http\Requests\Admin;

use wh1110000\CmsL8\Http\Requests\GeneralRequest;

/**
 * Class SettingRequest
 * @package Workhouse\Settings\Requests\Admin
 */

class SettingRequest extends GeneralRequest {

	/**
	 * @var array
	 */

	public $defaultRules = [

	];

	/**
	 * @var array
	 */

	public $allowedRulesVariables = [
		/*'logo' => [
			'mimes' => [
				'mimes' => 'jpeg,png,jpg,gif'
			]
		]*/
	];
}