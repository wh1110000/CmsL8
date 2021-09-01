<?php

namespace wh1110000\CmsL8\Services;

use Illuminate\Http\Request;

class CompiledRouteCollection extends \Illuminate\Routing\CompiledRouteCollection {

	/**
	 * Find the first route matching a given request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Routing\Route
	 *
	 * @throws \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 */
	protected function requestWithoutTrailingSlash(Request $request)
	{
		$trimmedRequest = Request::createFromBase($request);

		$parts = explode('?', $request->server->get('REQUEST_URI'), 2);

		$trimmedRequest->server->set(
			'REQUEST_URI', rtrim($parts[0], '').(isset($parts[1]) ? '?'.$parts[1] : '')
		//'REQUEST_URI', rtrim($parts[0], '/').(isset($parts[1]) ? '?'.$parts[1] : '')
		);

		return $trimmedRequest;
	}
}
