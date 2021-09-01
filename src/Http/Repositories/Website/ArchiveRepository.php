<?php

namespace wh1110000\CmsL8\Http\Repositories\Website;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use wh1110000\CmsL8\Models\Presenters\Archive;
use wh1110000\CmsL8\Http\Repositories\Admin\ArchiveCategoryRepository;
use wh1110000\CmsL8\Http\Repositories\WebRepository;

/**
 * Class ArchiveRepository
 * @package Workhouse\Archives\Repositories\Website
 */

class ArchiveRepository extends WebRepository {

	/**
	 * @var
	 */

	public $config;

	/**
	 * @var bool
	 */

	public $archive_filter = false;

	/**
	 * @var bool
	 */

	public $category_filter = false;

	/**
	 * @var bool
	 */

	public $country_filter = false;

	/**
	 * @var bool
	 */

	public $featured = true;

	/**
	 * ArticleRepository constructor.
	 */

	public function __construct() {

		$this->model = new Archive();

		parent::__construct();
	}

	/**
	 *
	 */

	public function getFilteredRecords(){

		$records = $this->model;

		if($this->category_filter && request()->has('category')) {

			$this->featured = false;

			$records = $records->whereHas('categories', function($query) {

				$query->where('link', request()->get('category'));
			});
		}

		if($this->archive_filter && request()->has('year')) {

			$this->featured = false;

			$records = $records->whereYear('published_at', request()->get('year'));
		}

		if($this->country_filter && request()->has('country')) {

			$this->featured = false;

			$records = $records->whereHas('countries', function($query) {

				$query->where('name', request()->get('country'));
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

			return in_array($value, ['page', 'order', 'page']) ? false : true;
		});

		if(request()->has('order')) {

			$direction = !request()->get('direction') || !in_array(request()->get('direction'), ['asc', 'desc']) ? 'desc' : request()->get('direction');

			$order = request()->get('order');

			$order = Schema::hasColumn($this->model->getTable(), $order) && (in_array($order, $this->model->getFillable()) || in_array($order, $this->model->getDates())) ? $order : 'title';

			$records = $records->orderBy($order, $direction);
		} else {

			$records = $records->orderBy('published_at', 'desc');
		}

		$records = $records->paginate(9, ['*'], 'page', ($currentUrlParameters || $previousUrlParameters) && $params ? 1 : null);

		return $records;
	}

	/**
	 * @param null $limit
	 *
	 * @return \Illuminate\Support\Collection
	 */

	public function getFeaturedRecords($limit = null){

		if($this->featured){
    
			$records = $this->model->latest()->featured();

			if($limit){

				$records = $records->limit($limit);
			}

			$records = $records->get();

		} else {

			$records = collect();
		}

		return $records;
	}

	/**
	 *
	 */

	public function setActiveFilters(){

		$this->config = config($this->postType);

		if(isset($this->config['filters'])){

			$config = $this->config['filters'];

			if(isset($config['archive'])){

				$archiveFilter = $config['archive'];

				$this->archive_filter = is_int($archiveFilter) || (bool) $archiveFilter == true;
			}

			if(isset($config['category'])){

				$this->category_filter = $config['category'];
			}

			if(config('app.translationby') == 'country' && isset($config['country'])){

				$this->country_filter = $config['country'];
			}
		}
	}

	/**
	 * @return array
	 */

	public function getFilters(){

		$this->setActiveFilters();

		$filters = [];

		if($this->archive_filter){

			$archiveFilter = $this->config['filters']['archive'];

			$sinceYear = is_int($archiveFilter) ? $archiveFilter : 5;

			$currentYear = date('Y');

			$filters['archives'] = collect(range($currentYear, $currentYear - $sinceYear));
		}

		if($this->category_filter){

			$categories = new ArchiveCategoryRepository();

			$filters['categories'] = $categories->model->get();
		}

		if($this->country_filter){

			$filters['countries'] = \Country::active()->get();
		}

		return $filters;
	}
}
