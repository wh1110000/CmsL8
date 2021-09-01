<?php

namespace wh1110000\CmsL8\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ShopCategory
 * @package Workhouse\Shops\Models
 */

class ShopCategory extends BaseModel {

	use SoftDeletes;

	/**
	 * @var array
	 */

	protected $fillable = [
		'title',
		'excerpt',
		'description',
	];

	/**
	 * @var array
	 */

	protected $uploadable = [
		'thumbnail'
	];

	/**
	 * @return HasMany
	 */

	public function shops() {

		return $this->hasMany(new \Shop)->orderBy('name');
	}
}