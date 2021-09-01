<?php

namespace wh1110000\CmsL8\Http\Requests\Admin;

use wh1110000\CmsL8\Http\Requests\GeneralRequest;

/**
 * Class AccountRequest
 * @package Workhouse\Permissions\Requests\Admin
 */

class PermissionRequest extends GeneralRequest {


	/**
	 * @var array
	 */

	public $defaultRules = [
		'name' => ['required','string'],
	];
}