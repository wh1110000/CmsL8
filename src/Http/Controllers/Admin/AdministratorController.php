<?php

namespace wh1110000\CmsL8\Http\Controllers\Admin;

/**
 * Class AdministratorController
 * @package Workhouse\Administrators\Controllers\Admin
 */

class AdministratorController extends Controller {

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function account(){

		return view('admin.administrator::account');
	}

	/**
	 * @return mixed
	 */

	public function saveAccount(){

		return $this->repository->updateAccount();
	}
}
