<?php

namespace wh1110000\CmsL8\Scopes\Website;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use wh1110000\CmsL8\Services\Route;

/**
 * Class isApprovedScope
 * @package Workhouse\Cms\Scopes
 */

class isApprovedScope implements Scope {

	/**
	 * @param Builder $builder
	 * @param Model $model
	 */

	public function apply(Builder $builder, Model $model){

			if(in_array('approved', $model->getFillable())){

			if(!auth()->guard('administrator')->check() || !request()->has('preview') || request('preview') !== csrf_token()){

				$builder->where('approved', true);

			}
		}
	}
}