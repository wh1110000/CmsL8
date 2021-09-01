<?php

namespace wh1110000\CmsL8\Traits;

/**
 * Trait Property
 * @package Workhouse\Cms\Traits
 */

trait Property {

	/**
	 * @param $name
	 *
	 * @return null
	 */

	public function getProperty($name){


		if($property = optional($this->properties->where('property', $name)->first())->value){

			return $this->transformModelValue($name, $property);
		}

		return null;
	}

	/**
	 * @return mixed
	 */

	public function properties() {

		$query = $this->morphMany('\Property', 'model');

		/*if(getCurrentLanguage() !== env('DEFAULT_URL_LOCALE')){

			$query = $query->with('translations');
		}*/

		return $query;
	}
}