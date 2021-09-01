<?php

namespace wh1110000\CmsL8\Http\Repositories\Admin;

use wh1110000\CmsL8\Http\Repositories\AdminRepository;

/**
 * Class AdministratorRepository
 * @package Workhouse\Administrators\Repositories\Admin
 */

class AdministratorRepository extends AdminRepository {

	/**
	 * @param null $slug
	 * @param null $closure
	 *
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */

	public function store($slug = null , $closure = null) {

		return parent::store($slug, function () {

			if($this->model->fill($this->request->except($this->model->exists ? ['email', 'password'] : []))->save()) {

				$this->model->syncRoles($this->request->input('role'));

				return true;
			}

			return false;
		});
	}

	/**
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */

	public function updateAccount(){

		$this->model = auth()->guard('administrator')->user();

		return $this->transaction($this->model, function (){

			$this->model->fill($this->request->except(['email', 'password']));

			if($this->request->input('new_password')){

				$this->model->password = $this->request->new_password;
			}

			return $this->model->save();
		});
	}
}