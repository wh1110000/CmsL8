<?php

namespace wh1110000\CmsL8\Models\Presenters;

use wh11100001906\Shops\Models\ShopCategory as BaseModel;

/**
 * Class ShopCategory
 * @package Workhouse\Shops\Presenters
 */

class ShopCategory extends BaseModel {

	/**
	 * @var array
	 */

	protected $translatable = [
		'title',
		'excerpt',
		'description'
	];

	/**
	 * @return mixed
	 */

	public function dataTable() {

		return \DataTable::of($this->query())
			->setRoute('admin.shop-category.index')
			->setColumns([
				'title'      => [
					'title'  => __('cms::general.title'),
					'width'  => 65,
					'filter' => [
						'type' => 'text'
					]
				],
			])
			->setActionButtons(function($category){

				return [
					\Button::edit(['admin.shop-category.show', $category]),
					\Button::delete(['admin.shop-category.destroy', $category])
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
			->addField(\Fields::textarea('excerpt')->add())
			->addField(\Fields::editor('description')->add())
			->addField(\Fields::file('thumbnail')->add())
			->addCol(6)
			->addSection(__('Logs'))
			->addField(\Fields::text('created_at')->disabled()->add())
			->addField(\Fields::text('updated_at')->disabled()->add());
	}
}
