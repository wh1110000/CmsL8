<?php

namespace wh1110000\CmsL8\Traits;

/**
 * Trait User
 * @package Workhouse\Cms\Traits
 */

trait User {

	/**
	 * @return string
	 */

	public function getFirstName(){

		return $this->first_name;
	}

	/**
	 * @return string
	 */

	public function getLastName(){

		return $this->last_name;
	}

	/**
	 * @return string
	 */

	public function getFullName(){

		$names = [
			$this->getFirstName(),
			$this->getLastName()
		];

		return implode(' ', array_filter($names));
	}

	/**
	 * @return string
	 */

	public function getUsername(){

		return $this->username;
	}
}