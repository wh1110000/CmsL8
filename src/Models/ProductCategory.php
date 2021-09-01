<?php

namespace wh1110000\CmsL8\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductCategory
 * @package Workhouse\Products\Models
 */

class ProductCategory extends BaseModel {

	use SoftDeletes;

	/**
	 * @var array
	 */

	protected $fillable = [
		'title',
		'description',
		'link'
	];

	protected $casts = [
		'thumbnail' => 'media'
	];

	/**
	 * @var array
	 */

	protected $uploadable = [
		'thumbnail'
	];

	/**
	 * @var array
	 */

	protected $with = [
		'products',
		'slug'
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */

	public function products() {

		return $this->belongsToMany('\Product')->orderBy('order')->orderBy('name');
	}
}