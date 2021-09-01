<?php

namespace wh1110000\CmsL8\Http\Repositories\Website;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use wh1110000\CmsL8\Http\Repositories\WebRepository;

/**
 * Class PageRepository
 * @package Workhouse\Pages\Website\Repositories
 */

class PageRepository extends WebRepository {

	/**
	 * @param $controller
	 *
	 * @return mixed|string
	 */

	public function action($controller){

		$method = Str::camel($this->model->type);

		$data = [];

		if(method_exists($controller, Str::camel($method))){

			$data = $controller->$method();

			if($data instanceof RedirectResponse || (is_string($data) && is_array(json_decode($data, true)) ? true : false)){

				return $data;
			}
		}

		$data = array_merge($data, ['namespace' => $this->routePrefix, 'page' => $this->model]);

		return $this->generateResponse('view', $data);
	}
}