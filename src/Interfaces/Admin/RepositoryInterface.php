<?php

namespace wh1110000\CmsL8\Interfaces\Admin;

/**
 * Interface GeneralRepositoryInterface
 * @package Workhouse\Cms\Admin\Interfaces
 */

interface RepositoryInterface {

	/**
	 * @param $slug
	 *
	 * @return mixed
	 */

	public function first($slug);

	/**
	 * @param $slug
	 * @param $request
	 *
	 * @return mixed
	 */

	public function store($slug, $request);

	/**
	 * @param $slug
	 *
	 * @return mixed
	 */

	public function destroy($slug);

	//HELPERS

	/**
	 * @param $slug
	 * @param \Closure $closure
	 * @param bool $json
	 *
	 * @return mixed
	 */

	public function transaction($slug, \Closure $closure, $json = false);

	/**
	 * @param $type
	 * @param $name
	 * @param $data
	 *
	 * @return mixed
	 */

	public function generateResponse($type, $name, $data);

	/**
	 * @param $view
	 * @param $data
	 *
	 * @return mixed
	 */

	public function view($view, $data);

	/**
	 * @param $route
	 * @param null $model
	 *
	 * @return mixed
	 */

	public function route($route, $model = null);
}