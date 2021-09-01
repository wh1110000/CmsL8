<?php

namespace wh1110000\CmsL8\Http\Repositories;

use Illuminate\Support\Str;
use wh1110000\CmsL8\Services\Route;

/**
 * Class GeneralRepository
 * @package Workhouse\Cms\Admin\Repositories
 */

class GeneralRepository {

	/**
	 * @var null
	 */

	public $view = null;

	/**
	 * @var bool
	 */

	protected $isModal = false;

	/**
	 * @var mixed
	 */

	public $model;

	/**
	 * @var null|string
	 */

	public $prefix;

	/**
	 * @var
	 */

	public $postType;

	/**
	 * @var
	 */

	public $modelName;

	/**
	 * @var
	 */

	public $namespace;

	/**
	 * @var
	 */

	public $postTypeLabel;

	/**
	 * @var
	 */

	protected $table;

	/**
	 * @var
	 */

	protected $request;
	public $requestClass;

	/**
	 * @var null
	 */

	public $type = null;

	/**
	 * @param $slug
	 *
	 * @deprecated Since 1.1
	 * @return mixed
	 */

	public function first($slug) {

		$post = $this->model->resolveRouteBinding($slug);

		//$post->setNamespace($this->namespace);

		$this->model = $post;

		return $this->model;

		return $this->getPost($slug);
	}

	/**
	 * @return array|\Illuminate\Http\Request|string
	 */

	public function getRequest(){

		$this->request = is_object($this->requestClass) ? \App::make(get_class($this->requestClass)) : request();

		return $this->request;
	}

	/**
	 * @return array|\Illuminate\Http\Request|string
	 */

	public function setRequest($request){

		$this->request = $request;
	}

	/**
	 * @param null $slug
	 * @param null $closure
	 *
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */

	public function store($slug = null, \Closure $closure = null){

		$this->request = $this->getRequest();

		return $this->transaction($slug, is_callable($closure) ? $closure : function () {

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

		if(is_object($slug)){

			$this->model = $slug;

		} elseif(is_string($slug)){

			$this->model = $this->getPost($slug);

			if(!$this->model){

				$redirectLink = $slug;
			}
		}

		\DB::beginTransaction();

		try {

			if($closure()){

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
	 * @param $type
	 * @param $name
	 * @param $data
	 *
	 * @return mixed
	 */

	public function generateResponse($type, $name, $data){

		$_name = $this->prefix.(Str::finish($this->namespace, ($type == 'route' ? '.' : '::').$name));

		if(is_null($name)){

			return $_name;
		}

		return $type($_name, $data);
	}

	/**
	 * @param $view
	 * @param $data
	 *
	 * @return mixed
	 */

	public function view(array $data = []){

		$data = array_merge($data, ['routePrefix' => $this->routePrefix, 'namespace' => $this->orgPackage]);

		return $this->generateResponse('view', $this->getView(), $data);
	}

	/**
	 * @param $route
	 * @param null $model
	 *
	 * @return mixed
	 */

	public function route($route = null, $model = null) {

		return $this->generateResponse( 'route', $route, $model );
	}

	//View Helpers

	/**
	 * @param bool $render
	 *
	 * @return mixed
	 */

	public function archivePage($render = true){

		$this->setView('index');

		$data = $this->model->dataTable($this->route());

		if(request()->ajax()){

			return $data;
		}

		return $render ? $this->view(compact( 'data')) : $data;
	}

	/**
	 * @param $slug
	 * @param bool $render
	 *
	 * @return mixed
	 */

	public function singleRecordPage($slug = null) {
		$render = true;
		$this->setView('show');

		$post = $this->getPost($slug);

		return $render ? $this->view(compact( 'post')) : $post;
	}

	/**
	 * @param $slug
	 * @param bool $set
	 *
	 * @return mixed
	 */

	public function getPost($slug, $set = true){

		 $post = is_null($slug) ? $this->model : $this->model->resolveRouteBinding($slug);

		 if($set){

		 	$this->model = $post;
		 }

		 return $post;
	}

	/**
	 * @param $view
	 */

	protected function setView($view){

		if(!$this->getView()){

			$this->view = $view;
		}
	}

	/**
	 * @return null
	 */

	protected function getView(){

		return $this->view;
	}
}
