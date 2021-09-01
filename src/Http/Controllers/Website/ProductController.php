<?php

namespace wh1110000\CmsL8\Http\Controllers\Website;

/**
 * Class ProductController
 * @package Workhouse\Products\Controllers\Website
 */

class ProductController extends Controller {

	public function index(){

		$this->repository->postType = 'product-category';

		$filters = $this->repository->getFilters();

		$products = $this->repository->getFilteredRecords();

		$page = $this->repository->model;

		return view('product::index', compact('page', 'filters', 'products'));
	}
}
