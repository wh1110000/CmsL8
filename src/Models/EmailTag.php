<?php

namespace wh1110000\CmsL8\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EmailTag
 * @package Workhouse\Contact\Models
 */

class EmailTag extends BaseModel {

	use SoftDeletes;

	/**
	 * @var array
	 */

	protected $fillable = [
		'tag',
	];

	/**
	 * @var bool
	 */

	protected $hasSeo = false;

	/**
	 * @return mixed
	 */

	public function getName(){

		return $this->tag;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */

	public function emails(){

		return $this->belongsToMany('\Email');
	}
}