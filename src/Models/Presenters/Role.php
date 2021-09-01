<?php

namespace wh1110000\CmsL8\Models\Presenters;

/**
 * Class Role
 * @package Workhouse\Permissions\Presenters
 */

class Role extends \wh1110000\CmsL8\Models\Role {

	/**
	 * @return mixed
	 */

	public function dataTable($route) {

		return \DataTable::of($this->where('guard_name', request()->route()->parameter('guard')))
		   ->setRoute(route($route.'index', ['guard' => request()->route()->parameter('guard')]))
			->setColumns([
			   'name' => [
			       'title' => __('cms::general.name'),
			       'filter' => [
			           'type' => 'text'
			       ]
			   ],
			   'permissions' => [
			       'title' => __('cms::general.permissions'),
			       'filter' => [
			           'type' => 'text'
			       ]
			   ]
			])
			->editColumn('name', function($role){

				return $role->getName();
			})
			->editColumn('permissions', function($role){

			   return $role->permissions->implode('name', '<br />');
			})
			->setActionButtons(function($role) use ($route) {

			   return [
			       \Button::edit([$route.'show', request()->route()->parameter('guard'),$role]),
			       \Button::delete([$route.'delete', request()->route()->parameter('guard'),$role])
			   ];
			})
			->make()
			->response();
	}

	/**
	 * @return array
	 */

	public function roleTab() {

		return \Row::init()
		    ->addCol(6)
		    ->addSection(__('cms::general.basic'))
		    ->addField(\Fields::text('name')->add())
		    ->addCol(6)
		    ->addSection(__('cms::general.permissions'))
		    ->addField(\Fields::multiselect('permissions')->values(\Permission::where('guard_name', request()->route()->parameter('guard'))->pluck('name', 'id'))->selected($this->permissions()->pluck('id', 'name'))->add());
	}
}