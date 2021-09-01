<?php

namespace wh1110000\CmsL8\Models;

use wh1110000\CmsL8\Traits\BindsDynamically;

/**
 * Class ArchiveArchiveCategory
 * @package Workhouse\Archives\Models
 */

class ArchiveArchiveCategory extends BaseModel {

	use BindsDynamically;

	/**
	 * @var bool
	 */

	protected $guarded = ['type'];

	/**
	 * @var bool
	 */

	public $timestamps = false;

	/**
	 * @param $postType
	 *
	 * @return ArchiveArchiveCategory
	 */

	public static function type($postType){

		$postType = implode(array_map(function($model) use ($postType ) {

			return $model == 'Archive' ? str_replace($model, $postType, $model) : $model;
		},
			preg_split('/(?=[A-Z])/',class_basename(get_called_class()))
		));

		$model = new self(['type' => $postType]);

		return $model;
	}
}