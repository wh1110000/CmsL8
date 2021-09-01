<?php

namespace wh1110000\CmsL8\Models\Presenters;

/**
 * Class Country
 * @package Workhouse\Multilanguage\Presenters
 */

class Country extends \wh1110000\CmsL8\Models\Country {

	/**
	 * @param $route
	 *
	 * @return mixed
	 */
	
	public function dataTable($route) {

		return \DataTable::of($this->where('active', 1))
			->setRoute($route.'index')
			->setColumns([
			   'name' => [
			       'title' => __('cms::general.name'),
			       'filter' => [
			           'type' => 'text',
			       ],
			       'width' => 40,
			   ],
			])
			->setActionButtons(function($content) use ($route) {

			   return [
				   \Button::edit([$route.'show', $content])
			   ];
			})
			->make()
			->response();
	}

	/**
	 * @return mixed
	 */

	public function defaultTab(){

		return \Row::init()
		           ->addCol(6)
		           ->addSection(__('cms::general.basic'))
		           ->addField(\Fields::text('title')->add())
		           ->addField(\Fields::text('label')->add())
		           ->addCol(6)
		           ->addSection(__('cms::general.basic'))
		           ->addField(\Fields::text('alpha2_code')->add())
		           ->addField(\Fields::text('alpha3_code')->add())
		           ->addField(\Fields::text('icon')->add());
	}
}

