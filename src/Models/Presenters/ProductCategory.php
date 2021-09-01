<?php

namespace wh1110000\CmsL8\Models\Presenters;

/**
 * Class ProductCategory
 * @package Workhouse\Products\Presenters
 */

class ProductCategory extends \wh1110000\CmsL8\Models\ProductCategory {

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
					'title'  => __('products::fields.title'),
					'width'  => 65,
					'filter' => [
						'type' => 'text'
					]
				],
			])
			->setActionButtons(function($category) use ($route) {

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
			->addField(\Fields::text('title', __('products::fields.title'))->add())
			->addField(\Fields::textarea('description', __('products::fields.description'))->add())
			->addField(\Fields::file('thumbnail', __('products::fields.thumbnail'))->add())
			->addCol(6)
			->addSection(__('cms::general.logs'))
			->addField(\Fields::text('created_at', __('products::fields.created_at'))->disabled()->add())
			->addField(\Fields::text('updated_at', __('products::fields.updated_at'))->disabled()->add());
	}
}
