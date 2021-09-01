<?php

namespace wh1110000\CmsL8\Http\Requests\Admin;

use wh1110000\CmsL8\Rules\CurrentPassword;

/**
 * Class AccountRequest
 * @package Workhouse\Administrator\Requests\Admin
 */

class AccountRequest extends AdministratorRequest {


	/**
	 * @var array
	 */

	public $inheritVariables = [
		'first_name',
		'last_name',
		'current_password',
		'new_password',
	];

	/**
	 * @return array
	 */

	public function rules() {

		parent::rules();

		$this->defaultRules['current_password'][] = new CurrentPassword();

		return $this->defaultRules;

	}
}