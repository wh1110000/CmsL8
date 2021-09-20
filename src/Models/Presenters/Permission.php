<?php

namespace wh1110000\CmsL8\Models\Presenters;
use wh1110000\CmsL8\Traits\Multilanguage;
use wh1110000\CmsL8\Traits\Seo;

/**
 * Class Permission
 * @package Workhouse\Permissions\Presenters
 */

class Permission extends \wh1110000\CmsL8\Models\Permission {

	use Seo, Multilanguage;
	/**
	 * @param $route
	 *
	 * @return mixed
	 */

	public function dataTable($route) {

		return \DataTable::of($this->where('guard_name', request()->route()->parameter('guard')))
		    ->setRoute(route($route.'index', ['guard' => request()->route()->parameter('guard')]))
			->setColumns([
			   'name' => [
			       'title' => __('core::general.name'),
			       'filter' => [
			           'type' => 'text'
			       ]
			   ]
			])
			->editColumn('name', function($role){

				return $role->getName();
			})
			->setActionButtons(function($role) use ($route) {

			   return [
			       \Button::edit([$route.'show', request()->route()->parameter('guard'), $role]),
			       \Button::delete([$route.'delete', request()->route()->parameter('guard'),$role])
			   ];
			})
			->make()
			->response();
	}

	/**
	 * @return array
	 */

	public function permissionsTab() {


		return \Row::init()
			->addCol(6)
			->addSection(__('core::general.basic'))
			->addField(\Fields::text('name')->add())
			->addColWhen($this->exists, 6)
			->addSection(__('core::general.roles'))
			->addField(\Fields::multiselect('roles')->disabled()->values(\Role::where('guard_name', request()->route()->parameter('guard'))->pluck('name', 'id'))->selected($this->roles()->pluck('id', 'name'))->add());
	}
}