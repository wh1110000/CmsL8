<?php

namespace wh1110000\CmsL8\Models;

use Illuminate\Support\Str;

/**
 * Class SocialMedia
 * @package Workhouse\SocialMedia\Models
 */

class SocialMedia extends BaseModel {

	/**
	 * @var array
	 */

	protected $fillable = [
		'service',
		'name',
		'url',
		'icon',
		'active'
	];

	/**
	 * @var array
	 */

	protected $casts = [
		'active' => 'boolean'
	];

	/**
	 * @return mixed
	 */

	public function getService(){

		return $this->service;
	}

	/**
	 * @return mixed
	 */

	public function getName(){

		return $this->name;
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
}