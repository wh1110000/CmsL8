<?php

namespace wh1110000\CmsL8\Models;

use wh1110000\CmsL8\Models\BaseModel;

/**
 * Class Country
 * @package Workhouse\Multilanguage\Models
 */

class Country extends BaseModel {

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

	public function getName(){

		return $this->name;
	}

	/**
	 * @return mixed
	 */

	public function getLabel(){

		return $this->label;
	}

	/**
	 * @return mixed
	 */

	public function getCode(){

		return $this->code;
	}

	/**
	 * @param int $alpha
	 *
	 * @return mixed
	 */

	public function getAlphaCode($alpha = 2){

		return strtolower($this->{'alpha'.$alpha.'_code'});
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
	 * @return mixed
	 */

	public function getLanguageCode(){

		return $this->language->code;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */

	public function language(){

		return $this->belongsTo('\Language');
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

		return $this->where('code', Request()->route('locale'));
	}
}