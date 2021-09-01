<?php

namespace wh1110000\CmsL8\Models\Presenters;

use Illuminate\Support\Str;
use wh1110000\CmsL8\Models\Administrator as AdministratorModel;

/**
 * Class Administrator
 * @package Workhouse\Administrators\Presenters
 */

class Administrator extends AdministratorModel {

	/**
	 * @return mixed
	 */

	public function dataTable(){

		return \DataTable::of($this->where('id', '!=' , auth()->user()->getId()))
			->setRoute('admin.administrator.index')
			->setColumns([
			   'name' => [
			       'title' => __('cms::general.name'),
			       'width' => 25,
			       'filter' => [
			           'type' => 'text',
			           'searchBy' => [
			               'first_name', 'last_name'
			           ]
			       ],
			   ],
			   'email' => [
			       'title' => __('cms::general.email'),
			       'width' => 25,
			       'filter' => [
			           'type' => 'text',
			       ],
			   ],
			   'roles' => [
			       'title' => __('cms::general.name'),
			       'width' => 25,
			       'filter' => [
			           'type' => 'select',
			           'values' => \Role::pluck('name', 'name')->prepend('','')
			       ],
			   ],
			])
			->editColumn('name', function($admin){

			   return $admin->getFullName();
			})
			->editColumn('roles', function($admin){

			   return $admin->roles->implode('name', '<br />');
			})
			->setActionButtons(function($admin) {

			   return [
			       \Button::edit(['admin.administrator.show', $admin]),
			       \Button::delete(['admin.administrator.show', $admin])
			   ];
			})
			->setOrderBy('last_name')
			->make()
			->response();
	}

	/**
	 * @return mixed
	 */

	public function AccountTab() {

		$row = \Row::init()
			->addCol(6)
			->addSection(__('cms::general.account_details'))
			->addField([
				\Fields::text('first_name')->add(),
				\Fields::text('last_name')->add()
			])
			->addField(\Fields::email('email')->disabled($this->exists)->add());

		if(Str::contains(\Route::currentRouteName(), ['account'])){

			$row->addSectionWhen(Str::contains(\Route::currentRouteName(), ['account']), __('cms::general.change_password'))
			    ->addField('<small class="d-block">'. ( __("cms::general.change_your_password" ) ) . '</small>')
			    ->addField(\Fields::password('current_password')->add())
			    ->addField(\Fields::password('new_password')->add())
			    ->addField(\Fields::password('new_password_confirmation')->add());

		} else {

			if($this->exists){
				$row->addSection(__('cms::general.change_password'))
				    ->addField('<a href="'.route('admin.administrator.password.email', $this).'" class="btn btn-warning btn-alert">'. __('cms::general.send_new_password').'</a>');
			}

			$row->addCol(6)
			    ->addSection(__('cms::general.roles'))
			    ->addField(\Fields::select('role')->values(\Role::all()->pluck('name', 'id'))->add());
		}

		return $row;
	}
}
