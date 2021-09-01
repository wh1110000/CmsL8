<?php

namespace wh1110000\CmsL8\Http\Requests\Admin;

use wh1110000\CmsL8\Models\Presenters\ArchiveCategory;
use wh1110000\CmsL8\Http\Requests\GeneralRequest;

/**
 * Class ArchiveRequest
 * @package Workhouse\Archives\Requests\Admin
 */

class ArchiveRequest extends GeneralRequest {

	/**
	 * @var array
	 */

	public $defaultRules = [
		'categories' => ['nullable','array'],
		'title' => ['required','string','max:191'],
		'short_description' => ['nullable','string'],
		'description' => ['required','string'],
		'thumbnail' => ['nullable','integer',],
		'banner' => ['nullable','integer'],
		'featured' => ['boolean'],
		'published' => ['boolean'],
	];

	/**
	 * @return array
	 */

	public function rules() {

		parent::rules();

		$categoryModel = new ArchiveCategory();

		$this->defaultRules['categories'][] = 'exists:'.$categoryModel->getTable().',id';

		return $this->defaultRules;
	}
}