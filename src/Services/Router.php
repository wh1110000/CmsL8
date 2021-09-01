<?php

namespace wh1110000\CmsL8\Services;

/**
 * Class Router
 * @package Workhouse\Cms\Helpers
 */

class Router extends \Illuminate\Routing\Router {

	/**
	 * @param array|string $methods
	 * @param string $uri
	 * @param mixed $action
	 *
	 * @return $this|\Illuminate\Routing\Route
	 */

	public function newRoute($methods, $uri, $action) {

		return (new Route($methods, $uri, $action))
			->setRouter($this)
			->setContainer($this->container);
	}

	public function setCompiledRoutes(array $routes)
	{
		$this->routes = (new CompiledRouteCollection($routes['compiled'], $routes['attributes']))
			->setRouter($this)
			->setContainer($this->container);

		$this->container->instance('routes', $this->routes);
	}
}