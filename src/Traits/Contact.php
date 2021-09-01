<?php

namespace wh1110000\CmsL8\Traits;

use Illuminate\Support\Str;

/**
 * Trait Contact
 * @package Workhouse\Cms\Traits
 */

trait Contact {

	/**
	 * @return mixed
	 */

	public function getEmail(){

		return $this->email;
	}

	/**
	 * @return mixed
	 */

	public function getPhone(){

		return $this->phone;
	}

	/**
	 * @return mixed
	 */

	public function getFax(){

		return $this->fax;
	}

	/**
	 * @param bool $fullUrl
	 *
	 * @return string
	 */

	public function getUrl($fullUrl = false) {

		$url = Str::finish($this->url, '/');

		return $fullUrl ? Str::finish($url, $this->getName()) : $url;
	}
}