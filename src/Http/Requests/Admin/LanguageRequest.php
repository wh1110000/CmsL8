<?php

namespace wh1110000\CmsL8\Http\Requests\Admin;

use wh1110000\CmsL8\Http\Requests\GeneralRequest;

/**
 * Class LanguageRequest
 * @package Workhouse\Multilanguages\Requests\Admin
 */

class LanguageRequest extends GeneralRequest {

	/**
	 * @var array
	 */

	public $defaultRules = [
		'name' => ['required','string','max:191'],
		'code' => ['required','string','max:5'],
		'icon'   => ['string','nullable'],
		//'priority' => ['integer', 'nullable'],
		'active' => ['required', 'boolean'],
	];
}