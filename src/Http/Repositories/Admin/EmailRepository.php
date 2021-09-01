<?php

namespace wh1110000\CmsL8\Repositories\Admin;

use wh1110000\CmsL8\Http\Repositories\AdminRepository;

/**
 * Class EmailRepository
 * @package Workhouse\Contact\Repositories\Admin
 */

class EmailRepository extends AdminRepository {

	/**
	 * @param $slug
	 * @param bool $set
	 *
	 * @return mixed
	 */

	public function getPost($slug, $set = true){

		if(request()->get('type') == 'trash'){

			$this->model = $this->model->withoutGlobalScopes()->findOrFail($slug);

			$slug = null;
		}

		return parent::getPost($slug, $set);
	}

	/**
	 * @param $slug
	 * @param null $closure
	 *
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */

	public function destroy($slug, $closure = null){

		return $this->transaction($slug, is_callable($closure) ? $closure : function () {

			return $this->model->trashed() ? $this->model->forceDelete() : $this->model->delete();

		}, true);
	}

	/**
	 *
	 */

	public function read(){

		$this->model->update(['read' => true]);

		$this->model = $this->model->fresh();
	}

	/**
	 * @param bool $important
	 *
	 * @return mixed
	 */

	public function important($important = true){

		return $this->model->update(['important' => $important]);
	}

	/**
	 * @param $to
	 */

	public function moveTo($to){

	}

	/**
	 * @param $tag
	 */

	public function addTag($tag){


	}

	/**
	 * @param $tag
	 */

	public function removeTag($tag){

	}
}