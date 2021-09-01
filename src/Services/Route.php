<?php

namespace wh1110000\CmsL8\Services;

use Illuminate\Routing\RouteBinding;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Class Route
 * @package Workhouse\Cms\Helpers
 */

class Route extends \Illuminate\Routing\Route {

	/**
	 * @var string
	 */

	private $divider = '\\';

	private $packageNamespace;

	private function appNamespace($key){

		return	Str::finish( config(  $key), $this->divider ) . Str::afterLast($this->packageNamespace, '\\'). (Str::contains($this->packageNamespace, '\\Auth') ? '\\' . (Route::isWebRoute() ? 'Website' : 'Admin') : '');
	}


	/**
	 * @return mixed
	 * @throws \Illuminate\Contracts\Container\BindingResolutionException
	 */

	public function getController() {

		if($this->controller){

			$class = $this->controller ? get_class($this->controller) : $this->parseControllerCallback()[0];

			$controllerName = Str::afterLast($class, $this->divider);

			$controllerPackageName = Str::lower(implode('-', array_filter(preg_split('/(?=[A-Z])/',Str::replaceLast('Controller', '', $controllerName)))));

			$this->packageNamespace = optional(request()->route())->getAction('namespace');

			if(!class_exists($class) && Str::startsWith($this->packageNamespace, 'Workhouse\Archives\\')){

				$archiveName = Str::beforeLast( Str::afterLast($class, '\\'), 'Controller');

				$class = str_replace($archiveName, 'Archive', $class);


				//$parentsClass = class_parents($class);

				//$class = str_replace('Archive', $archiveName,$class);

			}/* else {

				$parentsClass = class_parents($class);
			}*/
			/*if($class == 'Workhouse\Archives\Controllers\Website\InspirationController'){
				dd($class);
			}*/

			/*if($class == 'Workhouse\Cms\Controllers\Website\PageController'){
				dd($this->action);
			}*/

			$parentsClass = class_parents($class);



			//$parentsClass = class_parents($class);

			if(Str::startsWith($this->packageNamespace, 'App') && is_array($parentsClass) && ($newPackageNamespace = Arr::first($parentsClass, function ($value, $key) {

				return Str::beforeLast(Str::startsWith($value, 'Workhouse'), '\\');

			}))){

				$this->packageNamespace = Str::beforeLast($newPackageNamespace, '\\');
			}


			//if(!$this->controller){


				foreach([
					$this->appNamespace('general.controller_namespace'),
					$this->packageNamespace
				] as $namespace){

					if (class_exists($controller = $namespace . $this->divider .  $controllerName) ) {

						$this->controller = $this->container->make(ltrim($controller, '\\'));

						break;
					}
				}
			//}

			//REPOSITORY

			foreach ([
				$this->appNamespace( 'general.repository_namespace' ),
				Str::replaceLast( 'Controllers', 'Repositories', $this->packageNamespace )
			] as $_namespace ) {


				if ( class_exists( $repositoryName = $_namespace . $this->divider . Str::replaceLast( 'Controller', 'Repository', $controllerName ) ) ) {


					$repository = new $repositoryName;

					$package = Str::before(Str::after($this->packageNamespace, '\\'), '\Controllers');

					$repository->_package = lcfirst(Str::before(implode('',array_map('ucfirst', explode('-', $package))), '\\'));

					$repository->orgPackage = lcfirst(Str::before($package, '\\'));

					$repository->package = app('DoctrineInflector')->singularize(Str::before($package, '\\'));

					//$repository->_package = lcfirst(app('DoctrineInflector')->singularize(Str::before(implode('',array_map('ucfirst', explode('-', $package))), '\\')));

					if(!($controllerPackageName == $repository->package)){

						$repository->package = $controllerPackageName;

						$repository->_package = lcfirst(Str::before(implode('',array_map('ucfirst', explode('-', $repository->package))), '\\'));
					}

					if(Str::contains(Str::lower($repositoryName), ['category', 'categories'])){

						$repository->package  = Str::finish($repository->package, '-category');
					}

					$repository->prefix = self::isWebRoute() ? '' : 'admin';

					if(class_exists($model = '\\'.class_basename(Str::before($repositoryName, 'Repository')))) {

						$repository->model = $this->container->make($model);

						if ($slug = Route::getCurrentRouteName() === 'page.homepage' ? 'homepage' : request()->route()->parameter($repository->_package)) {

							$repository->model = $repository->model->resolveRouteBinding($slug)/*->with('translations')*/->firstOrFail();

							//dd($repository->model);
							//dd($repository->model->toArray());
							//dd($repository->model->getFile2('magazine_image')->getFile());
						}
					}

					$action = Str::after(request()->route()->getAction('uses'),'@');

					$repository->view =  (self::isWebRoute() ? '' : $repository->prefix . '.') .$repository->package . '::' . (Route::isWebRoute() && $repository->package == 'page' ? $repository->model->type : $action);

					$repository->routePrefix = (self::isWebRoute() ? '' : $repository->prefix . '.').  $repository->package . '.' ;

					$repository->route = $repository->routePrefix  .  $action;

					$this->controller->repository = $repository;

					//Request

					foreach ( [
						str_replace('\Controllers', '\Requests', $this->packageNamespace),
						$this->appNamespace('general.repository_namespace'),
					] as $__namespace ) {

						if ( class_exists( $requestName = Str::finish( $__namespace, $this->divider ) . Str::replaceLast( 'Controller', 'Request', $controllerName ) ) ) {

							$request = new $requestName;

							$request->model = $repository->model ?? null;

							$this->controller->repository->requestClass = $request;
						}
					}

					break;
				}


			}

			//MODEL

			//$router = new \Illuminate\Routing\Router(\App::make('events'), $this->container);

			/**
			 * @todo add website/admin for Str::finish( config( 'general.repository_namespace' ), $this->divider ) . (Str::contains($packageNamespace, '\\Auth\\') ? '\\Auth\\' : ''),
			 */


		} else {

			parent::getController();
		}

		if(isset($repository)){


			if($repository->orgPackage == 'archives'){

				$repository->package = 'archive';

				$repository->view = '::archive';
			}

			if($repository->package == 'product'){
				$repository->view = '::index';
			}

			$page = isset($repository->model) && $repository->model instanceof \Page ? $repository->model : (new \Page)->where('package', $repository->package)->where('type', Str::after($repository->view, '::'))->first();

			request()->attributes->add(['currentPage' => $page]);

			if(isset($repository->model)){

				request()->attributes->add(['currentPost' => $repository->model]);
			}
		}

		return $this->controller;
	}



	/**
	 * @param $repository
	 */

	public static function setRepository($repository) {

		request()->route()->getController()->repository = $repository;
	}

	/**
	 * @return mixed
	 */

	public static function getRepository(){

		return request()->route()->getController()->repository;
	}

	/**
	 * @return mixed
	 */

	public static function getCurrentRouteName(){

		return optional(request()->route())->getAction('as');
	}

	public static function getRoutes(){

		$routeNames = [];

		foreach (\Route::getRoutes()->getRoutes() as $route) {

			$action = $route->getAction();

			if (array_key_exists('as', $action)) {

				if(!Str::startsWith($action['as'], 'admin.') && !in_array($action['as'], $routeNames)){

					$routeNames[] = $action['as'];
				}
			}
		}

		return $routeNames;
	}

	/**
	 * @return mixed
	 */

	public static function isModal(){

		return Str::contains(self::getCurrentRouteName(), '.modal');
	}

	/**
	 * @return bool
	 */

	public static function isAdminRoute() {

		return self::getCurrentRouteName() ? Str::startsWith(self::getCurrentRouteName(), [ 'admin.' ] ) && !Str::startsWith(self::getCurrentRouteName(), [ 'admin.auth.' ] ) : Str::contains(app('request')->path(), '/admin/');
	}

	/**
	 * @return bool
	 */

	public static function isAdminAuthRoute() {

		return Str::startsWith(self::getCurrentRouteName(), [ 'admin.auth.' ] );
	}

	/**
	 * @return bool
	 */

	public static function isAuthRoute() {

		return Str::startsWith( self::getCurrentRouteName(), ['login', 'register', 'password'] );
	}

	/**
	 * @return bool
	 */

	public static function isWebRoute() {


		return !self::isAdminRoute() && !self::isAdminAuthRoute();
	}

	/**
	 * @param $package
	 * @param null $type
	 *
	 * @return array
	 * @throws \Exception
	 */

	public static function getWebRouteSlubByName($package, $type = null) {


		if($prefix = optional(\Page::setEagerLoads([])->withoutGlobalScopes()->where('package', '=', $package)->where('type', $type)->first())->getLink()){

			return $prefix;
		}

		throw new \Exception('No package '.$package .'('.($type ?: 'null'). ') found');
	}
}