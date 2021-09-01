<?php

namespace wh1110000\CmsL8\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Nav
 * @package Workhouse\Cms\Facades
 */

class Navigation extends Facade {

	/**
	 * @return string
	 */

	protected static function getFacadeAccessor() {

		return 'Navigation';
	}
}