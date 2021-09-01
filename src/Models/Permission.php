<?php

namespace wh1110000\CmsL8\Models;

use wh1110000\CmsL8\Traits\ModelHelper;

/**
 * Class Permission
 * @package Workhouse\Permissions\Models
 */

class Permission extends \Spatie\Permission\Models\Permission {

	use ModelHelper;
	/**
	 * @var bool
	 */

	protected $orginalLink = false;

	/**
	 * @var array
	 */

	public $fillable = [
		'name',
		'guard_name'
	];

	/**
	 * @return mixed
	 */

	public function getName(){

		return $this->name;
	}
}