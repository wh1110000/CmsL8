<?php

namespace wh1110000\CmsL8\Http\Repositories\Admin;

use wh1110000\CmsL8\Http\Repositories\AdminRepository;

/**
 * Class PageRepository
 * @package Workhouse\Pages\Repositories\Admin
 */

class PageRepository extends AdminRepository {

	/**
	 * @param $slug
	 * @param null $closure
	 *
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */

	public function destroy( $slug, $closure = null ) {

		return parent::destroy($slug, function () {

			if($this->model->isType('global')){

				throw new \Exception(__('cms::general.cant_delete_global_pages'));
			}

			return $this->model->delete();

		});
	}
}