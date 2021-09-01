<?php

namespace wh1110000\CmsL8\Repositories\Admin;

use wh1110000\CmsL8\Http\Repositories\AdminRepository;

/**
 * Class ProductCategoryRepository
 * @package Workhouse\Products\Repositories\Admin
 */

class ProductCategoryRepository extends AdminRepository {

	/**
	 * @param $slug
	 * @param null $closure
	 *
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */

	public function destroy( $slug, $closure = null ) {

		return parent::destroy($slug, function () {

			if($status = $this->model->delete()){

				$status = $this->model->products()->detach();
			}

			return $status;
		});
	}
}