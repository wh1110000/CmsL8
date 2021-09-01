<?php

namespace wh1110000\CmsL8\Http\Requests\Admin;

use wh1110000\CmsL8\Http\Requests\GeneralRequest;

/**
 * Class MediaRequest
 * @package Workhouse\Media\Requests\Admin
 */

class MediaRequest extends GeneralRequest {

	/**
	 * @var array
	 */

	public $defaultRules = [
		'service' => ['required','string','max:191'],
		'url' => ['required', 'url'],
		'name' => ['required','string','max:191'],
		'order' => ['integer']
	];
}