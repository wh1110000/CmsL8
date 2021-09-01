<?php

namespace wh1110000\CmsL8\Providers;

use wh1110000\CmsL8\Providers\AbstractServiceProvider;
use wh1110000\CmsL8\Services\Route;
use wh1110000\CmsL8\Services\Router;
use wh1110000\CmsL8\Http\Middleware\Authenticate;
use wh1110000\CmsL8\Http\Middleware\Guard;
use wh1110000\CmsL8\Models\Permission;
use wh1110000\CmsL8\Models\Role;

/**
 * Class PermissionsServiceProvider
 * @package Workhouse\Permissions\Providers
 */

class PermissionsServiceProvider extends AbstractServiceProvider {

	/**
	 *
	 */

	public function loadConfigs(){

		parent::loadConfigs();

		config(['permission.models.role' => Role::class]);
		config(['permission.models.permission' => Permission::class]);
	}

	/**
	 * @return mixed|void
	 */

	public function loadMiddlewares(){

		//if(auth()->guard('admin')->check()){

			$this->app['router']->pushMiddlewareToGroup('web', Guard::class);

			//$this->app['router']->pushMiddlewareToGroup('web', hasAccess::class);
		//}

	}
}
