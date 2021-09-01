<?php

namespace wh1110000\CmsL8\Http\Repositories\Admin;

use wh1110000\CmsL8\Models\Presenters\Archive;
use wh1110000\CmsL8\Http\Repositories\AdminRepository;

/**
 * Class ArchiveRepository
 * @package Workhouse\Archives\Repositories\Admin
 */

class ArchiveRepository extends AdminRepository {

	public function __construct() {

		$this->model = new Archive();
	}

	/**
	 * @param null $slug
	 *
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */

	public function store($slug = null, $closure = null){

		return parent::store($slug, function(){

			$request = $this->getRequest();

			if($this->model->fill($request->all())->save()) {

				if(!$this->request->has('translations')) {

					$this->model->categories()->sync( $request->input( 'categories' ));

					$this->model->countries()->sync( $request->input( 'countries' ));
				}

				return true;
			}

			return false;
		});
	}
}
