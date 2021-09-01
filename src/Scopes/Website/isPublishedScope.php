<?php

namespace wh1110000\CmsL8\Scopes\Website;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

/**
 * Class isPublishedScope
 * @package Workhouse\Core\Scopes
 */

class isPublishedScope implements Scope {

	/**
	 * @param Builder $builder
	 * @param Model $model
	 */

	public function apply(Builder $builder, Model $model){

		if(in_array('published', $model->getFillable())){

			if(!auth()->guard('administrator')->check() || !request()->has('preview') || request('preview') !== csrf_token()){

				$builder->where('published', true);

				if(in_array('published_at', $model->getDates())){

					$builder->where('published_at', '<=', Carbon::now()->format('Y-m-d H:i:s'));
				}
			}
		}
	}
}