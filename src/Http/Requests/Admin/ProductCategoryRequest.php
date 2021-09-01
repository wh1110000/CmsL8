<?php

namespace wh1110000\CmsL8\Http\Requests\Admin;

use wh1110000\CmsL8\Http\Requests\GeneralRequest;

/**
 * Class ProductCategoryRequest
 * @package Workhouse\Products\Requests\Admin
 */

class ProductCategoryRequest extends GeneralRequest {

	/**
	 * @var array
	 */

	public $defaultRules = [
		'title' => ['required','string','max:191'],
		'description' => ['nullable','string'],
		'thumbnail' => ['nullable','integer'],
	];
}