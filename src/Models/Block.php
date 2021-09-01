<?php

namespace wh1110000\CmsL8\Models;

/**
 * Class Page
 * @package Workhouse\Pages\Models
 */

class Block extends BaseModel {

	/**
	 * @var array
	 */

	protected $fillable = [
		'name',
		'template',
	];
}

