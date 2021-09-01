<?php

namespace wh1110000\CmsL8\Http\Repositories\Admin;

use wh1110000\CmsL8\Http\Repositories\AdminRepository;

/**
 * Class ProductRepository
 * @package Workhouse\Products\Repositories\Admin
 */

class ProductRepository extends AdminRepository {

	/**
	 * @param null $slug
	 * @param \Closure|null $closure
	 *
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */

	public function store($slug = null, \Closure $closure = null) {

		return parent::store( $slug, function() {

			$categories = $this->request->input('categories');

			$crossSells = $this->request->input('crossSells');

			if($this->model->fill($this->request->except(['categories']))->save()) {

				if(!$this->request->has('translations')){

					$this->model->categories()->sync($categories);

					$this->model->crossSells()->sync($crossSells);
				}

				return true;
			}

			return false;
		});
	}
}