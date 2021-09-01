<?php

namespace wh11100001906\Administrator\Requests\Admin;

use wh1110000\CmsL8\Models\Role;

/**
 * Class AuthRequest
 * @package Workhouse\Administrator\Requests\Admin
 */

class AuthRequest extends AdministratorRequest {

	/**
	 * @var array
	 */

	public $inheritVariables = [
		'first_name',
		'last_name',
		'email',
	];
}