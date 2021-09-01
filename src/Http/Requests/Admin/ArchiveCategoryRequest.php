<?php

namespace wh1110000\CmsL8\Http\Requests\Admin;

use wh1110000\CmsL8\Http\Requests\GeneralRequest;

/**
 * Class ArchiveCategoryRequest
 * @package Workhouse\Archives\Requests\Admin
 */

class ArchiveCategoryRequest extends GeneralRequest {

	/**
	 * @var array
	 */

	public $defaultRules = [
		'title' => ['required','string','max:191'],
		'description' => ['nullable','string'],
		'thumbnail' => ['nullable','integer',],
	];
}