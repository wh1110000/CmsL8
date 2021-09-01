<?php

namespace wh1110000\CmsL8\Traits;

use Cviebrock\EloquentSluggable\Sluggable;
use wh1110000\CmsL8\Services\Route;

/**
 * Trait User
 * @package Workhouse\Cms\Traits
 */

trait Slug {

	use Sluggable;

	/**
	 * @return mixed
	 */

	public function getLink($orginal = false, $forLanguage = null){

		$this->orginalLink = $orginal;

		if(Route::isWebRoute()){

			if($this->getRouteKeyName() != 'id' && $forLanguage || app('multilanguage')->getActiveLanguage() != env('DEFAULT_URL_LOCALE')){

				if($slug = $this->slug->where('lang', $forLanguage ?: app('multilanguage')->getActiveLanguage())->first()) {

					return $slug->text;

				} elseif($forLanguage) {

					if(isset($this->toArray()['link'])){

						return $this->toArray()['link'];
					}
				}
			}
		}

		return $this->{$this->getRouteKeyName()};
	}

	/**
	 * @return array
	 */

	public function sluggable() {

		foreach(['title', 'name', 'id'] as $source){

			return [
				$this->getRouteKeyName() => [
					'source' => $source
				]
			];
		}
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\MorphOne
	 */

	public function slug(){

		//return $this->translations()->where('field', $this->getRouteKeyName());

		/*if($this->orginalLink){

			return $this;
		}*/

		return $this->morphMany('\Lang', 'model')/*->where('lang', getCurrentLanguage())*/->where('field', $this->getRouteKeyName());
	}


}