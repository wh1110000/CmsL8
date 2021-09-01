<?php

namespace wh1110000\CmsL8\Http\Repositories;

use Illuminate\Support\Str;

/**
 * Class GeneralFrontendRepository
 * @package Workhouse\Cms\Admin\Repositories
 */

class GeneralFrontendRepository extends GeneralRepository {

	public $paginate = 10;

	public $data = [];

	/**
	 * @param array $variables
	 *
	 * @return mixed
	 */

	public function indexPage($variables = []){

		extract($variables);

		$var = app('DoctrineInflector')->pluralize(app('DoctrineInflector')->camelize($this->postType));

		if(!in_array($var, $variables)){

			${$var} = $this->getAll() ;
		}

		$this->setView('index');

		$this->setData(get_defined_vars());

		return $this->view();
	}


	public function recordPage($slug, $variables = []) {

		extract($variables);

		${app('DoctrineInflector')->singularize(app('DoctrineInflector')->camelize($this->postType))} = $this->getPost($slug);

		$this->setView('show');

		$this->setData(get_defined_vars());

		return $this->view();
	}

	/**
	 * @param $view
	 *
	 * @return mixed
	 */

	public function render($view, $data = []) {

		$this->setView($view);

		$this->setData($data);

		return $this->view();
	}

	public function setData($data = []){

		return $this->data = $data;
	}

	/**
	 * @param $view
	 * @param $data
	 *
	 * @return mixed
	 */

	public function view(array $data = []){

		$this->data = array_merge($this->data, ['namespace' => $this->namespace]);

		return $this->generateResponse('view', $this->getView(), $this->data);
	}

	/**
	 * @param $type
	 * @param $name
	 * @param $data
	 *
	 * @return mixed|string
	 */

	public function generateResponse($type, $name, $data){

		$_name = $this->prefix.(Str::finish($this->postType, ($type == 'route' ? '.' : '::').$name));

		if(is_null($name)){

			return $_name;
		}

		return $type($_name, $data);
	}

	/**
	 * @param $type
	 * @param $name
	 *
	 * @return string
	 */

	public function generateResponseName($type, $name){

		return $this->prefix.(Str::finish($this->postType, ($type == 'route' ? '.' : '::').$name));
	}

	public function getRecordBySlug($slug = null) {

		return is_null($slug) ? $this->model : $this->model->resolveRouteBinding($slug);
	}

	public function getAll(){

		return is_int($this->paginate) ? $this->model->paginate($this->paginate) : $this->model->get();
	}

	/**
	 * @param $slug
	 *
	 * @return mixed
	 */

	public function getOne($slug){

		return $this->getRecordBySlug($slug);
	}
}