<?php

namespace wh1110000\CmsL8\Http\Requests\Admin;

use wh1110000\CmsL8\Http\Requests\GeneralRequest;

/**
 * Class ShopCategoryRequest
 * @package Workhouse\Shops\Requests
 */

class ShopCategoryRequest extends GeneralRequest {

	/**
	 * @var array
	 */

	public $defaultRules = [
		'title' => ['required','string','max:191'],
		'excerpt' => ['nullable','string'],
		'description' => ['nullable','string'],
	];
}