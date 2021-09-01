<?php

namespace wh1110000\CmsL8\Models\Presenters;

/**
 * Class Language
 * @package Workhouse\Multilanguage\Presenters
 */

class Language extends \wh1110000\CmsL8\Models\Language {


	/**
	 * @param $route
	 *
	 * @return mixed
	 */
	
	public function dataTable($route) {

		$model = $this;

		if(config('app.translationby') == 'country'){

			$model = $model->whereIn('id', \Country::where('active', 1)->pluck('language_id'));

		} else {

			$model = $model->where('active', 1);
		}

		return \DataTable::of($model)
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
			->addField(\Fields::text('title')->add());
	}
}

