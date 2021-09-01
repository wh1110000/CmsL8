<?php

namespace wh1110000\CmsL8\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Seo
 * @package Workhouse\Seo\Models
 */

class Seo extends Model {

	/**
	 * @var string
	 */

	protected $table = 'seo';

	/**
	 * @var array
	 */

	protected $fillable = [
		'model_id',
		'model_type',
		'meta_title',
		'meta_description',
	];
}
