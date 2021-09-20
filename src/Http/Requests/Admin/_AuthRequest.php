<?php

namespace wh1110000\CmsL8\Http\Requests\Admin;

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