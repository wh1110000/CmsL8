<?php

namespace wh1110000\CmsL8\Http\Repositories;

use Illuminate\Support\Str;

/**
 * Class GeneralRepository
 * @package Workhouse\Cms\Admin\Repositories
 */

class AdminRepository extends GeneralRepository {

	protected $request;

	/**
	 * @param bool $render
	 *
	 * @return mixed
	 */

	public function archivePage($render = true){

		$data = $this->model->dataTable($this->routePrefix);

		if(request()->ajax()){

			return $data;
		}

		return $render ? $this->view(compact( 'data')) : $data;
	}

	/**
	 * @param null $slug
	 *
	 * @return mixed
	 */

	public function singleRecordPage($slug = null) {

		$post = $this->model;

		return $this->view(compact( 'post'));
	}

	/**
	 * @param null $slug
	 * @param null $closure
	 *
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */

	public function store($slug = null, \Closure $closure = null){

		$this->request = $this->getRequest();

		return $this->transaction($slug, is_callable($closure) ? $closure : function() {

			if($this->model->fill($this->request->all())->save()) {

				return true;
			}

			return false;
		});
	}

	/**
	 * @param $slug
	 * @param null $closure
	 *
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */

	public function destroy($slug, $closure = null){

		return $this->transaction($slug, is_callable($closure) ? $closure : function () {

			return $this->model->delete();

		}, true);
	}

	//HELPERS

	/**
	 * @param $slug
	 * @param \Closure $closure
	 * @param bool $json
	 *
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */

	public function transaction($slug, \Closure $closure, $json = false){
		$prevLink = null;

		$redirectLink = null;

		/*if(is_object($slug)){

			$this->model = $slug;

		} else*/if(is_string($slug)){

			//$this->model = $this->getPost($slug);

			if(!$this->model){

				$redirectLink = $slug;
			}
		}

		\DB::beginTransaction();

		try {

			if($closure($this)){

				\DB::commit();

				if($this->model->exists){

					$redirectLink = $this->route('show', $this->model);

				}

				return $json ? response()->json(["success" => true]) : redirectBack(true, $redirectLink);
			}

		} catch (\Exception $e) {

			report($e);
		}

		\DB::rollback();

		return $json ? response()->json(["success" => false]) : redirectBack();
	}

	/**
	 * @param null $route
	 * @param null $model
	 *
	 * @return mixed
	 */

	public function route($route = null, $model = null) {

		return $this->generateResponse( 'route', $route, $model );
	}

	/**
	 * @param $type
	 * @param $name
	 * @param $data
	 *
	 * @return mixed
	 */

	public function generateResponse($type, $name, $data){

		if($type == 'route'){

			$name = (Str::finish($this->routePrefix, ($type == 'route' ? '' : '::').$name));
		}

		return $type($name, $data);
	}
}
