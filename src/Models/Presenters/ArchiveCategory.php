<?php

namespace wh1110000\CmsL8\Models\Presenters;

use wh1110000\CmsL8\Models\ArchiveCategory as BaseModel;

/**
 * Class ArchiveCategory
 * @package Workhouse\Articles\Presenters
 */

class ArchiveCategory extends BaseModel {

	/**
	 * @var array
	 */

	protected $translatable = [
		'title',
		'description'
	];

	/**
	 * @return mixed
	 */

	public function dataTable($route) {

		return \DataTable::of($this)
			->setRoute($route.'index')
			->setColumns([
			   'title'      => [
			       'title'  => __('core::general.title'),
			       'width'  => 65,
			       'filter' => [
			           'type' => 'text'
			       ]
			   ],
			])
			->setActionButtons(function($category) use ($route){

				return [
					\Button::edit([$route.'show', $category]),
					\Button::delete([$route.'destroy', $category])
				];
			})
			->make()
			->response();
	}

	/**
	 * @return array
	 */

	public function contentTab() {

		return \Row::init()
			->addCol(6)
			->addSection(__('General'))
			->addField(\Fields::text('title')->add())
			->addField(\Fields::textarea('description')->add())
			->addCol(6)
			->addSection(__('Logs'))
			->addField(\Fields::text('created_at')->disabled()->add())
			->addField(\Fields::text('updated_at')->disabled()->add())
			->addSection(__('Images'))
			->addField(\Fields::file('thumbnail')->add());
	}
}