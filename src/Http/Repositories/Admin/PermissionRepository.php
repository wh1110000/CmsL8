<?php

namespace wh1110000\CmsL8\Repositories\Admin;

use wh1110000\CmsL8\Http\Repositories\AdminRepository;

/**
 * Class PermissionRepository
 * @package Workhouse\Permissions\Repositories\Admin
 */

class PermissionRepository extends AdminRepository {

	/**
	 * @param null $slug
	 * @param \Closure $closure
	 *
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */

	public function store($slug = null, \Closure $closure = null) {

		return parent::store($slug, function() {

			if($this->model->fill(array_merge(['guard_name' => request()->route()->parameter('guard')], $this->request->all()))->save()){

				return true;
			}

			return false;
		});
	}
}