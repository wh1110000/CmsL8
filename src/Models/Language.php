<?php

namespace wh1110000\CmsL8\Models;

/**
 * Class Language
 * @package Workhouse\Multilanguage\Models
 */

class Language extends BaseModel {

	/**
	 * @var array
	 */

	protected $fillable = [
		'active'
	];

	/**
	 * @var array
	 */

	protected $casts = [
		'active' => 'boolean',
	];

	/**
	 * @var bool
	 */

	public $hasMultilanguage = false;

	/**
	 * @var bool
	 */

	public $timestamps = false;

	/**
	 * @return mixed
	 */

	public function getLabel(){

		return strtoupper($this->getLanguageCode());
	}

	/**
	 * @return mixed
	 */

	public function getLanguageCode(){

		return $this->code;
	}

	/**
	 * @return mixed
	 */

	public function getCode(){

		return $this->getLanguageCode();
	}

	/**
	 * @param int $alpha
	 *
	 * @return mixed
	 */

	public function getAlphaCode($alpha = 2){

		return strtolower($this->getLanguageCode());
	}

	/**
	 * @return mixed
	 */

	public function getIcon(){

		return $this->icon;
	}

	/**
	 * @return mixed
	 */

	public function isActive(){

		return $this->active;
	}

	/**
	 * @param null $key
	 *
	 * @return mixed
	 */

	public function getDefaultLanguage($key = null){

		$language = $this->orderBy('priority', 'asc')->where('active', 1)->first();

		return is_null($key) ? $language : $language->{$key};
	}

	/**
	 * @param $query
	 *
	 * @return mixed
	 */

	public function scopeActive($query) {

		return $query->where('active', 1);
	}

	/**
	 * @return mixed
	 */

	public function scopeCurrent(){

		return $this->where('code', \App::getLocale())->first();
	}
}