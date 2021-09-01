<?php

namespace wh1110000\CmsL8\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use wh1110000\CmsL8\Services\Cast;

/**
 * Class Property
 * @package Workhouse\Cms\Models
 */

class Property extends BaseModel {

	use SoftDeletes;

	/**
	 * @var array
	 */

	protected $fillable = [
		'model_id',
		'model_type',
		'property',
		'value',
		'type',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */

	public function properties() {

		return $this->morphTo('\Page');
		//return $this->morphTo('\Page')->with('translations');
	}

	/**
	 * @return mixed
	 */

	public function getType(){

		return $this->type;
	}

	/**
	 * @return mixed
	 */

	public function getValue(){

		return $this->value;
	}

	/**
	 * @return \Illuminate\Support\Carbon|\Illuminate\Support\Collection|int
	 */

	/*public function cast(){

		return $this->getValue();
		return Cast::attribute($this->getType(), $this->getValue());
	}*/

	/**
	 * Repeater
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */

	public function fields() {

		return $this->hasMany('\Property', 'model_id', 'id');
	}

	/**
	 * @return HasMany
	 */

	public function groups() {

		return $this->hasMany('\Property', 'model_id', 'id')->with('fields');
	}
}