<?php

namespace wh1110000\CmsL8\Http\Controllers\Admin;

use wh1110000\CmsL8\Http\Requests\ModalRequest;

/**
 * Class CountryController
 * @package Workhouse\Multilanguage\Admin
 */

class CountryController extends Controller {

	/**
	 * @param ModalRequest $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function showManageModal(ModalRequest $request){

		$countries = $this->repository->model->get();

		if($request->action == 'add'){

			\Country::where('active', 1)->update(['active' => 0]);

			\Country::whereIn('id', $request->get('countries'))->update(['active' => 1]);

			view()->share('result', true);
		}

		return view('admin.country::modal.show', compact('countries'));
	}
}