<?php

namespace wh1110000\CmsL8\Http\Controllers\Admin;

use wh1110000\CmsL8\Http\Requests\Modal\ModalRequest;

/**
 * Class LanguageController
 * @package Workhouse\Multilanguage\Controllers\Admin
 */

class LanguageController extends Controller {

	/**
	 * @param ModalRequest $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function showManageModal(ModalRequest $request){

		$languages = $this->repository->model->get();

		if($request->action == 'add'){

			\Language::where('active', 1)->update(['active' => 0]);

			$activeLanguages = $request->get('languages');

			if(!$activeLanguages){

				$activeLanguages = [1];
			}

			\Language::whereIn('id', $activeLanguages)->update(['active' => 1]);

			view()->share('result', true);
		}

		return view('admin.languages::modal.show', compact('languages'));
	}
}