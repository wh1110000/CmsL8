<?php

namespace wh1110000\CmsL8\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package Workhouse\Products\Models
 */

class Product extends BaseModel {

	use SoftDeletes;

	/**
	 * @var array
	 */

	protected $fillable = [
		'name',
		'short_description',
		'description',
		'sku',
		'order',
		'link'
	];

	/**
	 * @var array
	 */

	protected $casts = [
		'thumbnail' => 'media',
		'gallery' => 'mediaArray',
		'order' => 'int'
	];

	/**
	 * @var array
	 */

	protected $uploadable = [
		'thumbnail',
		'gallery'
	];

	/**
	 * @var array
	 */

	protected $with = [
		'slug'
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */

	public function categories() {

		return $this->belongsToMany('\ProductCategory');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */

	public function crossSells() {

		return $this->belongsToMany('\Product', \ProductProductCrossSells::getTableName(), 'product_id', 'product_cross_sell_id');
	}

	/**
	 * @return mixed
	 */

	public function scopeFirstCategory(){

		return $this->categories()->first();
	}
}
