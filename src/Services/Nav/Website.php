<?php

namespace wh1110000\CmsL8\Services\Nav;

use Illuminate\Support\Str;
use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Menu;
use Spatie\Menu\Html;

/**
 * Class Website
 * @package Workhouse\Cms\Helpers\Nav
 */

class Website {

	public $navigations;

	public $query;

	/**
	 * Website constructor.
	 */

	public function __construct(){

		$this->navigations = \Nav::doesnthave('hasNotPermissions')->get();
	}

	/**
	 * @param $position
	 * @param null $id
	 *
	 * @return \Workhouse\Pages\Presenters\Nav
	 */

	public function blocks($position, $id = null){

		$query = clone $this->navigations;

		$position = is_array($position) ? $position : [$position];

		$query = $query->whereIn('link', $position);

		if($id){

			$query = $query->whereId($id);
		}

		return $query;
	}

	/**
	 * @param $position
	 * @param null $id
	 * @param null $closure
	 *
	 * @return Menu
	 */

	public function render($position, $id = null, $closure = null){

		$menu = Menu::build($this->getPages($position, $id), function ($menu, $link) {

			$menu->add( $link );

		});

		if($closure){

			$menu->add(Html::raw($closure));
		}

		$menu->setActiveClassOnParent(false)
		->setExactActiveClass('active')
		->setActiveClassOnLink()
		->setActiveClassOnParent()
		->setActive(\Request::url());


		return $menu;
	}

	/**
	 * @param $position
	 * @param $id
	 *
	 * @return array
	 */

	private function getPages($position, $id){

		$routes = $this->getRoutes();

		$pages = [];

		$this->blocks($position, $id)->each(function ($nav) use ($routes, &$pages, $position) {

			foreach ($nav->pages as $page) {

				if(!$page->default){

					continue;
				}

				/*if($page->getType() == 'external') {

					$route = $page->default->content;



				} else*/


				if(in_array($page->getType(), $routes)){

					if (in_array($page->getType(), ['login', 'register'])) {

						if(auth()->check()){

							if($page->isType('register')){

								continue;

							} else {

								$page->type = 'logout';
								$page->title = __('Logout');
							}

						} else {

							if (!app('SettingsManager')->get('ALLOW_LOGIN') || ($page->getType() == 'register' && !app('SettingsManager')->get('ALLOW_REGISTRATION'))) {

								continue;
							}
						}
					}

					$route = route($page->getType());

				} else if(in_array($page->default->package.'.index', $routes)){

					$route = route($page->default->package.'.index');

				} else {

					$route = route('page.show', $page->default->getLink());
					//$route = route('page.show', $page->default->getLink());
				}

				array_push($pages, Link::to($route, $page->getTitle()));


			}
		});

		return $pages;
	}

	/**
	 * @return array
	 */

	private function getRoutes(){

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
}