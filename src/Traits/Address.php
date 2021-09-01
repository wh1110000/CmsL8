<?php

namespace wh1110000\CmsL8\Traits;

/**
 * Trait Address
 * @package Workhouse\Cms\Traits
 */

trait Address {

	/**
	 * @return string
	 */

	public function getStreet(){

		return ucfirst($this->street);
	}

	/**
	 * @return string
	 */

	public function getExtraStreet(){

		return ucfirst($this->street_extra);
	}

	/**
	 * @return string
	 */

	public function getCity(){

		return ucfirst($this->city);
	}

	/**
	 * @return string
	 */

	public function getCounty(){

		return ucfirst(optional($this->county)->getLabel());
	}

	/**
	 * @return string
	 */

	public function getPostcode(){

		return strtoupper($this->postcode);
	}

	/**
	 * @return string
	 */

	public function getCountry(){

		return ucfirst(optional($this->country)->getName());
	}

	/**
	 * @param bool $inline
	 *
	 * @return string
	 */

	public function getFullAddress($inline = true){

		return implode($inline ? ', ' : '<br />', array_filter([
			$this->getStreet(),
			$this->getExtraStreet(),
			$this->getCity(),
			$this->getCounty(),
			$this->getPostcode(),
			$this->getCountry()
		]));
	}
}