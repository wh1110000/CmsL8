<?php

namespace wh1110000\CmsL8\Http\Repositories\Website;

use Illuminate\Support\Str;
use wh1110000\CmsL8\Http\Repositories\WebRepository;

/**
 * Class ProductRepository
 * @package Workhouse\Products\Repositories\Website
 */

class ProductRepository extends WebRepository {

	/**
	 * @var bool
	 */

	public $category_filter = false;

	/**
	 *
	 */

	public function getFilteredRecords(){

		$records = $this->model;

		if($this->category_filter && request()->has('category')) {

			$records = $records->whereHas('categories', function($query) {

				$query->where('link', request()->get('category'));
			});
		}

		$currentUrlParameters = $previousUrlParameters = [];

		if(Str::contains(url()->full(), '?')){

			$currentUrlParameters = explode('&', Str::after(url()->full(), '?'));
		}

		if(Str::contains(url()->previous(), '?')){

			$previousUrlParameters = explode('&', Str::after(url()->previous(), '?'));
		}

		$params = array_filter(array_merge(array_diff($currentUrlParameters, $previousUrlParameters), array_diff($previousUrlParameters, $currentUrlParameters)), function ($value){

			$value = Str::before($value, '=');

			return in_array($value, ['page', 'order']) ? false : true;
		});

		if(request()->has('order')) {

			$direction = !request()->get('direction') || !in_array(request()->get('direction'), ['asc', 'desc']) ? 'desc' : request()->get('direction');

			$order = request()->get('order');

			$order = Schema::hasColumn($this->model->getTable(), $order) && (in_array($order, $this->model->getFillable()) || in_array($order, $this->model->getDates())) ? $order : 'title';

			$records = $records->orderBy($order, $direction);

		} else {

			$records = $records->orderBy('created_at', 'desc');
		}

		$records = $records->paginate(6, ['*'], 'page', ($currentUrlParameters || $previousUrlParameters) && $params ? 1 : null);

		return $records;
	}

	/**
	 *
	 */

	public function setActiveFilters(){

		$this->category_filter = true;
	}

	/**
	 * @return array
	 */

	public function getFilters(){

		$this->setActiveFilters();

		$filters = [];

		if($this->category_filter){

			$filters['categories'] = $this->model->get();
		}

		return $filters;
	}
}