<?php

namespace wh1110000\CmsL8\Http\Controllers\Website;

/**
 * Class ArchiveController
 * @package Workhouse\Archives\Controllers\Website
 */

class ArchiveController extends Controller {

	/**
	 * @return mixed
	 */

	public function index(){

		$filters = $this->repository->getFilters();

		$posts = $this->repository->getFilteredRecords();

		$featuredPosts = $this->repository->getFeaturedRecords(1);

		$this->repository->render('index');

		return $this->repository->view(compact('filters', 'posts', 'featuredPosts'));
	}

	/**
	 * @return mixed
	 */

	public function show() {

		$this->repository->render('show');

		return $this->repository->view([]);
	}
}
