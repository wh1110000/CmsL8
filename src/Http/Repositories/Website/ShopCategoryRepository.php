<?php

namespace wh1110000\CmsL8\Http\Repositories\Website;

use wh1110000\CmsL8\Http\Repositories\WebRepository;

/**
 * Class ShopCategoryRepository
 * @package Workhouse\Shops\Repositories\Website
 */

class ShopCategoryRepository extends WebRepository {

	/**
	 * @param bool $render
	 *
	 * @return mixed
	 */

	public function archivePage( $render = true ) {

		$this->setView('categories');

		$categories = $this->model->limit ? $this->model->paginate($this->model->limit) : $this->model->get();

		return $this->view(compact('categories'));
	}

	/**
	 * @param null $slug
	 * @param bool $render
	 *
	 * @return mixed
	 */

	public function singleRecordPage($slug = null, $render = true){

		$this->setView('category');

		$category = $this->model->resolveRouteBinding($slug);

		$shops = $category->shops()->get();

		return $render ? $this->view( compact( 'category', 'shops')) : $category;
	}
}