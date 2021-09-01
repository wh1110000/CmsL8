<?php

namespace wh1110000\CmsL8\Models;

use wh1110000\CmsL8\Traits\ModelHelper;

/**
 * Class Role
 * @package Workhouse\Permissions\Models
 */

class Role extends \Spatie\Permission\Models\Role {

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