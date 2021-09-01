<?php

namespace wh1110000\CmsL8\Models;

use Illuminate\Support\Str;
use wh1110000\CmsL8\Models\BaseModel;

/**
 * Class Setting
 * @package Workhouse\Settings\Models
 */

class Setting extends BaseModel {

	/**
	 * @var array
	 */

	protected $fillable = [
		'key',
		'value',
	];

	/**
	 * @var array
	 */

	protected $uploadable = [
		'LOGO',
		'BRAND_LOGO',
		'FAVICON',
		'LOGO_DARK',
	];

	/**
	 * @var bool
	 */

	protected $hasSeo = false;

	/**
	 * @return mixed
	 */

	public function getKey(){

		return Str::upper($this->key);
	}

	/**
	 * @return mixed
	 */

	public function getValue(){

		return $this->value;
	}

	/**
	 * @param $key
	 */

	public function setKeyAttribute($key) {

		$this->attributes['key'] = Str::upper($key);
	}

	/**
	 * @param string $key
	 * @param mixed $value
	 *
	 * @return \Illuminate\Support\Carbon|mixed
	 */

	protected function transformModelValue($key, $value) {

		if($key != 'key') {

			return parent::transformModelValue($this->key, $value);
		}

		return parent::transformModelValue($key, $value);
	}
}