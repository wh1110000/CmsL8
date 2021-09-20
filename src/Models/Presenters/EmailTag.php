<?php

namespace wh1110000\CmsL8\Models\Presenters;

use wh1110000\CmsL8\Models\EmailTag as BaseModel;

/**
 * Class EmailTag
 * @package Workhouse\Contact\Presenters
 */

class EmailTag extends BaseModel {

	/**
	 * @var array
	 */

	public $translatable = [
		'tag',
		'link',
	];

	/**
	 * @param $route
	 *
	 * @return mixed
	 */

	public function dataTable($route) {

		return \DataTable::of($this)
			->setRoute($route.'index')
			->setColumns([
				'tag' => [
			        'title' =>  __('core::fields.tag'),
			        'width' => 85,
			        'filter' => [
			            'type' => 'text',
			        ],
			    ],
			])
			->setActionButtons(function($faq) use ($route) {

				return [
					\Button::edit([$route.'show', $faq]),
					\Button::delete([$route.'destroy', $faq])
				];
			})
			->make()
			->response();
	}

	/**
	 * @return array
	 */

	public function form() {

		return \Row::init()
			->addCol(12)
			->addSection(__('core::general.basic'))
			->addField(\Fields::text('tag', __('core::fields.tag'))->add());
	}
}