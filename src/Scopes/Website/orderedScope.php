<?php

namespace wh1110000\CmsL8\Scopes\Website;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use wh1110000\CmsL8\Services\Route;

/**
 * Class OrderedScope
 * @package Workhouse\Cms\Scopes
 */

class orderedScope implements Scope {

	/**
	 * @param Builder $builder
	 * @param Model $model
	 */

	public function apply(Builder $builder, Model $model){

		$builder->orderBy( $model->getTable() .'.'.($model->orderBy ?? ( $model->timestamps ? $model->getCreatedAtColumn() : $model->getKeyName() )), $this->orderByDirection ?? 'desc' );
	}
}