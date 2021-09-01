<?php

namespace wh1110000\CmsL8\Traits;

/**
 * Trait Seo
 * @package Workhouse\Seo\Traits
 */

trait Seo {

	/**
	 * @return mixed
	 */

	public function metaFieldsForm(){

		return \Row::init()
			->addCol(6)
			->addSection(__('Meta Data'))
			->addField(\Fields::text('meta_title', __('seo::fields.meta_title'))->add())
			->addField(\Fields::textarea('meta_description', __('seo::fields.meta_description'))->add());
	}

	/**
	 * @return bool
	 */

	public function hasSeo(){

		if(property_exists($this, 'hasSeo')) {

			return $this->hasSeo;
		}

		return false;
	}

	/**
	 * @param $key
	 * @param null $default
	 *
	 * @return mixed|null
	 */

	public function getMeta($key, $default = null){

		if($this->seo){

			return $this->transformModelValue('meta_'.$key, $this->seo->{'meta_'.$key}) ?: $default;
		}

		return $default;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\MorphOne
	 */

	public function seo() {

		return $this->morphOne('\Seo', 'model');
	}
}
