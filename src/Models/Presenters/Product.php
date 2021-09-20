<?php

namespace wh1110000\CmsL8\Models\Presenters;

/**
 * Class Product
 * @package Workhouse\Products\Presenters
 */

class Product extends \wh1110000\CmsL8\Models\Product {

	/**
	 * @var array
	 */

	protected $translatable = [
		'name',
		'short_description',
		'description',
	];

	/**
	 * @return mixed
	 */

	public function getSku(){

		return $this->sku;
	}

	/**
	 * @return mixed
	 */

	public function dataTable($route) {

		$dataTable = \DataTable::of($this)
			->setRoute($route.'index')
			->setColumns([
			   'name' => [
			       'title' => __('core::fields.name'),
			       'width' => 50,
			       'filter' => [
			           'type' => 'text',
			       ],
			   ],
			   'sku' => [
			       'title' => __('core::fields.sku'),
			       'width' => 30,
			       'filter' => [
			           'type' => 'text',
			       ],
			   ]
			])
			->setActionButtons(function($product) use ($route){

				return [
					\Button::edit([$route.'show', $product]),
					\Button::delete([$route.'destroy', $product])
				];
			})
			->make()
			->response();

		return $dataTable;
	}

	/**
	 * @return array
	 */

	public function ContentTab() {

		$categories = \ProductCategory::pluck('title', 'id');

		$row = \Row::init()
			->addCol(6)
			->addSection(__('core::general.basic'))
			->addField(\Fields::text('name', __('core::fields.name'))->add())
			->addField(\Fields::text('sku', __('core::fields.sku'))->add())
			->addField(\Fields::editor('short_description', __('core::fields.short_description'))->add())
			->addField(\Fields::editor('description', __('core::fields.description'))->add())
			->addField(\Fields::file('thumbnail', __('core::fields.thumbnail'))->add())
			->addSection(__('core::general.checkout'))
			->addField(\Fields::text('order_product', __('core::fields.order_product'))->add())
			->addField(\Fields::text('order_sample', __('core::fields.order_sample'))->add())
			->addCol(6)
			->addSection(__('core::general.categories'))
			->addField(\Fields::multiselect('categories[]', __('core::fields.categories'))->values($categories)->selected($this->categories()->pluck('product_categories.id', 'product_categories.title'))->add())
			->addSectionWhen($this->exists, __('core::general.logs'))
			->addField(\Fields::text('created_at', __('core::fields.created_at'))->disabled()->add())
			->addField(\Fields::text('updated_at', __('core::fields.updated_at'))->disabled()->add());


		return $row;
	}
	/**
	 * @return array
	 */

	public function CrossSellTab() {

		$row = \Row::init()
		    ->addCol(6)
			->addSection(__('core::fields.crossSells'))
			->addField(\Fields::multiselect('crossSells[]', __('core::fields.crossSells'))->values($this->where('id', '!=', $this->getId())->pluck('name', 'id'))->selected($this->crossSells()->pluck((new \Product)->getTable().'.id', (new \Product)->getTable().'.name'))->add());

		return $row;
	}
}
