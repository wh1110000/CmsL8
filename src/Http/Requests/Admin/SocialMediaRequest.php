<?php

namespace wh1110000\CmsL8\Http\Requests\Admin;

use wh1110000\CmsL8\Http\Requests\GeneralRequest;

/**
 * Class SocialMediaRequest
 * @package Workhouse\SocialMedia\Requests\Admin
 */

class SocialMediaRequest extends GeneralRequest {

	/**
	 * @var array
	 */

	public $defaultRules = [
		'service' => ['required','string','max:191'],
		'url' => ['required', 'url'],
		'name' => ['required','string','max:191']
	];
}