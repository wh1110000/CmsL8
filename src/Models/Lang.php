<?php

namespace wh1110000\CmsL8\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Lang
 * @package Workhouse\Multilanguage\Models
 */

class Lang extends Model {

	//use SoftDeletes;

	/**
	 * @var array
	 */

	protected $fillable = [
		'model_type',
		'model_id',
		'model_post_type',
		'field',
		'text',
		'lang'
	];

	/**
	 * @var bool
	 */

	public $timestamps = false;

	/**
	 * @return mixed
	 */

	public function getValue(){

		return $this->text;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */

	public function langs() {

		return $this->morphTo();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */

	public function model(){

		return $this->morphTo();
	}
}