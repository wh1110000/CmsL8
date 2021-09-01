<?php

namespace wh1110000\CmsL8\Http\Requests\Admin;

use wh1110000\CmsL8\Http\Requests\GeneralRequest;

/**
 * Class RoleRequest
 * @package Workhouse\Permissions\Requests\Admin
 */

class RoleRequest extends GeneralRequest {


	/**
	 * @var array
	 */

	public $defaultRules = [
		'name' => ['required','string'],
	];
}