<?php

namespace wh1110000\CmsL8\Http\Requests\Admin;

use wh1110000\CmsL8\Http\Requests\GeneralRequest;

/**
 * Class ProductRequest
 * @package Workhouse\Products\Requests\Admin
 */

class ProductRequest extends GeneralRequest {

	/**
	 * @var array
	 */

	public $defaultRules = [
		'name' => ['required','string','max:191'],
		'sku' => ['required','string','max:191'],
		'short_description' => ['nullable','string'],
		'description' => ['required','string'],
		'categories' => ['nullable','array'],
		'thumbnail' => ['nullable', 'integer'],
		'gallery' => ['nullable', 'array'],
	];

	/**
	 * @return array
	 */

	public function rules() {

		parent::rules();

		$this->defaultRules['categories'][] = 'exists:'.\ProductCategory::getTableName().',id';

		return  $this->defaultRules;
	}
}