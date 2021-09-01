<?php

namespace wh1110000\CmsL8\Traits;

use Illuminate\Support\Str;
use wh1110000\CmsL8\Services\Route;
use wh1110000\CmsL8\Models\Lang;

/**
 * Trait Multilanguage
 * @package Workhouse\Multilanguage\Traits
 */

trait Multilanguage {

	/**
	 * @var array
	 */

	//public $defaultFields = [];

	/**
	 * @param $key
	 *
	 * @return null|string
	 */

	/*public function translation($key) {

		$value = null;

		if ( Route::isAdminRoute() ) {

			if ( $key == $this->getRouteKeyName() ) {

				if ( $this->orginalLink ) {

					return $value;
				}
			}
		}

		if ( in_array( $key, $this->getTranslatableFields() ) ) {

			$query = $this->getModelQuery( $key );

			if ( $result = optional( $query->first() )->getValue() ) {

				$value = $result;

			} else {

				if ( request()->has( 'translations' ) ) {

					if ( $key !== 'link' ) {

						return '';
					}
				}
			}

		}

		return $value;
	}*/

	/**
	 * @param $key
	 *
	 * @return mixed
	 */

	/*public function getModelQuery($key){

		$language = request()->has('translations') ? (request('translations') ?: \Language::getDefaultLanguage('code')) : app()->getLocale();

		$query = $this->morphOne(Lang::class, 'model')->where('field', $key)->where('lang', $language); // edited

		if(Str::startsWith($this->getMorphClass(), 'article')){

			$query->where('model_post_type', $this->getPostType());
		}

		return $query;
	}*/

	/**
	 * @param $value
	 *
	 * @return null
	 */

	/*public function getSlug($value){

		$language = app()->getLocale();

		if(!Route::isAdminRoute() && ($this->hasMultilanguage() && in_array($this->getRouteKeyName(), $this->getTranslatableFields()))) {

			$query = Lang::where( 'model_type', $this->getMorphClass() )->where( 'text', $value )->where('lang', $language)->where('field', $this->getRouteKeyName());

			if($this->getMorphClass() == 'article'){

				$query->where('model_post_type', $this->getPostType());
			}

			return optional($query->first())->model;
		}

		return null;
	}*/

	/**
	 * @return array
	 */

	public function getTranslatableFields(){

		//$fields = $this->translatable ?? $this->defaultFields;
		//$fields = $this->translatable ?? $this->defaultFields;

		$fields = $this->translatable ?? [];

		if(property_exists($this, 'mergeTranslatable')){

			$fields = array_merge($fields, $this->mergeTranslatable ?? []);
		}

		return array_merge($fields, method_exists($this, 'hasSeo') && $this->hasSeo() ? ['meta_title', 'meta_description'] : []);
	}

	public function hasMultilanguage(){

		//if(!Route::isAdminRoute() || (Route::isAdminRoute() && request()->has('translations'))){

		if(method_exists($this, 'getTranslatableFields')){

			if(!empty($this->getTranslatableFields() ?? [])) {

				if ( property_exists( $this, 'hasMultilanguage' ) ) {

					return $this->hasMultilanguage;

				} else {

					return true;
				}
			}
		}

		//}

		return false;
	}

	/**
	 * @return mixed
	 */

	public function translations(){

		if(app('multilanguage')->getActiveUrlLocale() != env('DEFAULT_URL_LOCALE')){

			return $this->morphMany('\Lang', 'model')->where('lang', app('multilanguage')->getActiveUrlLocale());
		}

		return $this;
	}

	/**
	 * @return $this
	 */

	/*public function propertyTranslation(){

		if(getCurrentLanguage() !== app('SettingsManager')->get('DEFAULT_LANGUAGE')){

			return $this->morphOne('\Lang', 'model')->where('lang', getCurrentLanguage());
		}

		return $this;
	}*/
}
