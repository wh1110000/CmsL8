<?php

namespace wh1110000\CmsL8\Http\Requests\Admin;

use wh1110000\CmsL8\Http\Requests\GeneralRequest;

/**
 * Class AdministratorRequest
 * @package Workhouse\Administrator\Requests\Admin
 */

class AdministratorRequest extends GeneralRequest {

	/**
	 * @var array
	 */

	public $defaultRules = [
		'first_name' => ['required','string','max:191'],
		'last_name' => ['required','string','max:191'],
		'email'   => ['email','max:191'],
		'current_password' => ['required_with:new_password','required_with:password_new_confirmation','nullable'],
		'new_password' => ['nullable','required_with:current_password','min:6','confirmed'],
		'role' => ['required']
	];

	/**
	 * @return array
	 */

	public function rules() {

		$admin = request('administrator');

		$uniqueEmail = 'unique:administrators,email';

		if(optional($admin)->exists()){

			$this->defaultRules['email'][] = $uniqueEmail.','.$admin->getId();

		} else {

			$this->defaultRules['email'][] = 'required';
			$this->defaultRules['email'][] = $uniqueEmail;
		}


		$this->defaultRules['role'][] = 'exists:'.\Role::getTableName().',id';

		return parent::rules();
	}
}