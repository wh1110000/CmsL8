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
			       'title' => __('products::fields.name'),
			       'width' => 50,
			       'filter' => [
			           'type' => 'text',
			       ],
			   ],
			   'sku' => [
			       'title' => __('products::fields.sku'),
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
			->addSection(__('cms::general.basic'))
			->addField(\Fields::text('name', __('products::fields.name'))->add())
			->addField(\Fields::text('sku', __('products::fields.sku'))->add())
			->addField(\Fields::editor('short_description', __('products::fields.short_description'))->add())
			->addField(\Fields::editor('description', __('products::fields.description'))->add())
			->addField(\Fields::file('thumbnail', __('products::fields.thumbnail'))->add())
			->addSection(__('products::general.checkout'))
			->addField(\Fields::text('order_product', __('products::fields.order_product'))->add())
			->addField(\Fields::text('order_sample', __('products::fields.order_sample'))->add())
			->addCol(6)
			->addSection(__('products::general.categories'))
			->addField(\Fields::multiselect('categories[]', __('products::fields.categories'))->values($categories)->selected($this->categories()->pluck('product_categories.id', 'product_categories.title'))->add())
			->addSectionWhen($this->exists, __('cms::general.logs'))
			->addField(\Fields::text('created_at', __('products::fields.created_at'))->disabled()->add())
			->addField(\Fields::text('updated_at', __('products::fields.updated_at'))->disabled()->add());


		return $row;
	}
	/**
	 * @return array
	 */

	public function CrossSellTab() {

		$row = \Row::init()
		    ->addCol(6)
			->addSection(__('products::fields.crossSells'))
			->addField(\Fields::multiselect('crossSells[]', __('products::fields.crossSells'))->values($this->where('id', '!=', $this->getId())->pluck('name', 'id'))->selected($this->crossSells()->pluck((new \Product)->getTable().'.id', (new \Product)->getTable().'.name'))->add());

		return $row;
	}
}
