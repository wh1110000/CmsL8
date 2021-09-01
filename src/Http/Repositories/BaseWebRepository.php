<?php

namespace wh1110000\CmsL8\Http\Repositories;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Class BaseRepository
 * @package Workhouse\Cms\Admin\Repositories
 */

class BaseWebRepository {

	/**
	 * @var
	 */

	private $page;

	/**
	 * @var
	 */

	private $post;

	/**
	 * @var GeneralFrontendRepository
	 */

	private $repository;

	/**
	 * @var
	 */

	public $action;

	/**
	 * BaseRepository constructor.
	 */

	public function __construct() {

		$class = \Route::current()->controller;

		$calledClass = property_exists($class, 'model') ? $class->model : class_basename($class);

		$namespace = (\Route::current()->action['namespace']);

		$model = null;

		if($modelName = app('DoctrineInflector')->singularize(Str::replaceLast('Controller', '',Str::afterLast($calledClass, '\\')))){

			$modelName = '\\'.$modelName;

			$model = new $modelName;

			if($modelName) {

				$slug = is_object($model) ? ($model->getPostType() == 'page' ? (request( 'page') ?: 'homepage') : $model->getPostType()) : Str::slug($modelName);


				$model = \Page::where( 'link', $slug )->first();

				if(!$model){

					$model = \Page::where( 'link', app('DoctrineInflector')->pluralize($slug))->first();
				}

				$this->page = $model;
			}

		}

		$slug = Arr::first(request()->route()->parameters());

		$this->post = false;

		if($slug){

			if($model){

				$_model = $model->getModelName();

				$_model = '\\'.$_model;

				$_model = new $_model;

				$post = is_object($slug) ? $slug : $_model->where('link', $slug)->first();

				if($post != $this->page){

					$this->post = $post;
				}
			}
		}

		$class = \Route::current()->controller;

		if(property_exists($class, 'model')){

			$c = Str::beforeLast(get_class($class), '\\') . '\\'.$class->model.'Controller';

		} else {

			$c = get_class( $class );
		}

		if(Str::startsWith($c, 'App\\Http')){

			$c = get_parent_class($c);
		}

		$repository = Str::replaceLast('Controller', 'Repository', Str::replaceLast('\\', '\\Repositories\\', $c));


		//if($model){
		//if(class_exists($repository)){

			$this->repository = class_exists($repository) ? new $repository() : ($model ? new \Workhouse\Cms\Admin\Repositories\GeneralFrontendRepository($model) : null);
		//}

		$this->action = \Route::current()->getAction('uses');

	}

	/**
	 * @return mixed
	 */

	public function getPage(){

		return $this->page;
	}

	/**
	 * @return mixed
	 */

	public function getPost(){

		return $this->post;
	}

	/**
	 * @return GeneralFrontendRepository
	 */

	public function getRepository(){

		return $this->repository;
	}
}