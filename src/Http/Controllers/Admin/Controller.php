<?php

namespace wh1110000\CmsL8\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;

/**
 * Class Controller
 * @package Workhouse\Cms\Controllers\Admin
 */

class Controller extends BaseController {

	/**
	 * @var 
	 */

	public $repository;

	/**
	 * @return mixed
	 */

	public function index(){

		return $this->repository->archivePage();
	}

	/**
	 * @param null $slug
	 *
	 * @return mixed
	 */

	public function show($slug = null) {

		return $this->repository->singleRecordPage($slug);
	}

	/**
	 * @param null $slug
	 *
	 * @return mixed
	 */

	public function store($slug = null) {

		return $this->repository->store($slug);
	}

	/**
	 * @param $slug
	 *
	 * @return mixed
	 */

	public function destroy($slug) {

		return $this->repository->destroy($slug);
	}
}
