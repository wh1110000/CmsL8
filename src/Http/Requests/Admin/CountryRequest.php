<?php

namespace wh1110000\CmsL8\Http\Requests\Admin;

use wh1110000\CmsL8\Http\Requests\GeneralRequest;

/**
 * Class CountryRequest
 * @package Workhouse\Multilanguages\Requests\Admin
 */

class CountryRequest extends GeneralRequest {

	/**
	 * @var array
	 */

	public $defaultRules = [
		'language_id' => ['required','exists:Workhouse\Multilanguage\Models\Language,id'],
		'name' => ['required','string','max:191'],
		'label' => ['required','string','max:191'],
		'code' => ['required','string','max:5'],
		'alpha2_code' => ['required','string','max:5'],
		'alpha3_code' => ['required','string','max:5'],
		'icon'   => ['string','nullable'],
		//'priority' => ['integer', 'nullable'],
		'active' => ['required', 'boolean'],
	];
}