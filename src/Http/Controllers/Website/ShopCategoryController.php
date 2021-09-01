<?php

namespace wh1110000\CmsL8\Http\Controllers\Website;

/**
 * Class ShopCategoryController
 * @package Workhouse\Shops\Website
 */

class ShopCategoryController extends Controller {

	/**
	 * @return mixed
	 */

	public function indexCategories() {

		return $this->repository->archivePage();
	}

	/**
	 * @param $category
	 *
	 * @return mixed
	 */

	public function showCategory($category) {

		return $this->repository->singleRecordPage($category);
	}
}
