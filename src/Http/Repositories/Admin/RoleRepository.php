<?php

namespace wh1110000\CmsL8\Repositories\Admin;

use wh1110000\CmsL8\Http\Repositories\AdminRepository;

/**
 * Class RoleRepository
 * @package Workhouse\Permissions\Repositories\Admin
 */

class RoleRepository extends AdminRepository {

	/**
	 * @param null $slug
	 * @param bool $render
	 *
	 * @return mixed
	 */

	public function singleRecordPage( $slug = null, $render = true ) {

		$post = $this->model;

		$permissions = \Permission::where('guard_name', request()->route()->parameter('guard'))->get();

		return $this->view(compact( 'post', 'permissions'));
	}

	/**
	 * @param null $slug
	 * @param \Closure|null $closure
	 *
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */

	public function store( $slug  = null, \Closure $closure = null) {

		return parent::store($slug, function(){

			$permissions = $this->request->input('permissions');

			$this->request->request->remove('permissions');

			if($result = $this->model->fill(array_merge(['guard_name' => request()->route()->parameter('guard')], $this->request->all()))->save()){

				if(!$this->request->has('translations')) {

					$this->model->syncPermissions($permissions);
				}
			}

			return $result;
		});
	}
}