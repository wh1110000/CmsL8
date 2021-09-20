<?php

namespace wh1110000\CmsL8\Models\Presenters;

use wh1110000\CmsL8\Http\Repositories\Admin\ArchiveCategoryRepository;
use wh1110000\CmsL8\Models\Archive as BaseModel;

/**
 * Class Archive
 * @package Workhouse\Archives\Presenters
 */

class Archive extends BaseModel {

	/**
	 * @var array
	 */

	protected $translatable = [
		'title',
		'short_description',
		'description',
		'link'
	];

	public $orderBy = 'published_at';

	/**
	 * @return mixed
	 */

	public function dataTable($route) {

		return \DataTable::of($this)
		    ->setRoute($route.'index')
			->setColumns([
			   'title' => [
			       'title' => __('core::general.title'),
			       'width' => 50,
			       'filter' => [
			           'type' => 'text',
			       ],
			   ],
			   'published_at' => [
			       'title' => __('core::general.published_at'),
			       'width' => 10,
			       'filter' => [
			           'type' => 'date',
			       ],
			   ],
			   'updated_at' => [
			       'title' => __('core::general.updated_at'),
			       'width' => 10,
			       'filter' => [
			           'type' => 'date',
			       ],
			   ],
			   'created_at' => [
			       'title' => __('core::general.created_at'),
			       'width' => 10,
			       'filter' => [
			           'type' => 'date',
			       ],
			   ],
			])
			->setOrderBy('published_at')
			->setActionButtons(function($article) use ($route){

			   return [
				   \Button::edit([$route.'show', $article]),
				   \Button::delete([$route.'destroy', $article])
			   ];
			})
			->make()
			->response();
	}

	/**
	 * @return array
	 */

	public function contentTab() {

		$categories = new ArchiveCategoryRepository();

		//$categories = \ArticleCategory::get();


		$form = \Row::init()
			->addCol(6)
			->addSection(__('core::general.basic'))
			->addField(\Fields::text('title')->add())
			->addField(\Fields::editor('short_description')->add())
			->addField(\Fields::editor('description')->add())
			->addCol(6)
			->addSectionWhen($this->exists, __('Logs'))
			->addField(\Fields::text('created_at')->disabled()->add())
			->addField(\Fields::text('updated_at')->disabled()->add())
			->addSection(__('Publish'))
			->addField(\Fields::datepicker('published_at')->add())
			->addField(\Fields::bool('published')->selected($this->published)->add())
			->addSection(__('core::general.images'))
			->addField(\Fields::file('thumbnail')->add())
			->addField(\Fields::file('banner')->add())
			->addSection(__('core::general.categories'))
			->addField(\Fields::multiselect('categories[]')->values($categories->model->pluck('title', 'id'))->add());


		if (config('app.translationby') == 'country'){

			$form = $form->addSection(__('countries'))
				->addField(\Fields::multiselect('countries[]')->values(\Country::active()->pluck('label', 'id'))->add());
		}

		return $form;
	}
}
