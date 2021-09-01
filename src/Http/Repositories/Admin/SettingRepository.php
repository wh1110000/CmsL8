<?php

namespace wh1110000\CmsL8\Http\Repositories\Admin;

use wh1110000\CmsL8\Http\Repositories\AdminRepository;

class SettingRepository extends AdminRepository {

	/**
	 * @param null $slug
	 * @param \Closure|null $closure
	 *
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */

	public function store( $slug = null, \Closure $closure = null) {

		return parent::store($slug, function() {

			foreach ($this->request->input('settings') as $key => $value){

				$this->model->updateOrCreate(['key' => $key], ['value' => $value]);
			}

			return true;
		});

	}
}