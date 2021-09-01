<?php

namespace wh1110000\CmsL8\Models;

use Illuminate\Support\Str;
use wh1110000\CmsL8\Traits\BindsDynamically;
use wh1110000\CmsL8\Models\BaseModel;

/**
 * Class ArchiveCategory
 * @package Workhouse\Archives\Models
 */

class ArchiveCategory extends BaseModel {

	use BindsDynamically;

	/**
	 * @var array
	 */

	protected $fillable = [
		'title',
		'description',
		'link',
	];

	/**
	 * @var array
	 */

	protected $uploadable = [
		'thumbnail'
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */

	public function articles() {

		$model = Str::replaceLast('Category', '', $this->getModelName());

		$model = new $model;

		$table = app('DoctrineInflector')->singularize($model->getTable());

		return $this->belongsToMany($model, Str::finish($table,'_'.$table.'_category'), Str::finish($table, '_category_id'), Str::finish($table, '_id') );
	}

	/**
	 * @param $postType
	 *
	 * @return ArticleCategory
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