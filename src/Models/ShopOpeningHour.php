<?php

namespace wh1110000\CmsL8\Models;


/**
 * Class ShopOpeningHour
 * @package Workhouse\Shops\Models
 */

class ShopOpeningHour extends BaseModel {

	/**
	 * @var array
	 */

	protected $fillable = [
		'retailer_id',
		'day',
		'date',
		'label',
		'open_time',
		'close_time',
	];

	/**
	 * @var bool
	 */

	public $timestamps = false;

	/**
	 * @var array
	 */

	protected $translatable = [
		'day',
		'label',
	];
}
