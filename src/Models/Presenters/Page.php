<?php

namespace wh1110000\CmsL8\Models\Presenters;

/**
 * Class Page
 * @package Workhouse\Pages\Presenters
 */

class Page extends \wh1110000\CmsL8\Models\Page {

	/**
	 * @var array
	 */

	public $translatable = [
		'title',
		'short_description',
		'content',
		'excerpt',
		'link',
	];

	/**
	 * @var bool
	 */

	protected $hasSeo = true;

	/**
	 * @var array
	 */

	public $row = [];

	//
	//protected $with = [
		/*'translations',
		'slug',
		'permissions'*/
	//];
	
	/**
	 * @param $route
	 *
	 * @return mixed
	 */
	
	public function dataTable($route) {

		return \DataTable::of($this)
			->setRoute($route.'index')
			->setColumns([
			   'title' => [
			       'title' => __('pages::fields.title'),
			       'filter' => [
			           'type' => 'text',
			       ],
			       'width' => 40,
			   ],
			   'link' => [
				   'title' => __('pages::fields.link'),
				   'filter' => [
					   'type' => 'text',
				   ],
				   'width' => 40,
			   ],
			   'type' => [
				   'title' => __('pages::fields.type'),
				   'filter' => [
					   'type' => 'select',
					   'values' => collect(['internal' => 'Internal', 'external' => 'External', 'global' => 'Global', 'archive' => 'Archive'])->prepend('','')
				   ],
			   ],
			])
			->setActionButtons(function($content) use ($route) {

				$buttons [] = \Button::edit([$route.'show', $content]);

				if(!$content->isType('global')){

					$buttons[] = \Button::delete([$route.'destroy', $content]);
				}

			   return $buttons;
			})
			->make()
			->response();
	}

	/**
	 * @return array
	 */

	public function contentTab(){

		$type = $this->getType() ?: (request()->has('type') ? request()->get('type') : 'internal');

		$this->row = \Row::init()
			->addCol(6)
			->addSection(__('cms::general.basic'))
			->addField(\Fields::text('title')->add());

		if($type == 'external'){

			$this->row->addField(\Fields::text('content', 'Url')->add());

		} else{

			$this->row->addField(\Fields::textarea('excerpt')->add())
				->addField(\Fields::textarea('short_description')->add())
				->addField(\Fields::editor('content')->add());
		}

		if($this->getLink()){

			$this->{$this->getLink().'Form'}();
		}

		if($this->exists){

			$this->row->addField(\Fields::text('link')->add());

		} else {

			$this->row->addField(\Fields::hidden('type')->value($type)->add());
		}

		$this->row->addField(\Fields::bool('published')->selected($this->published)->add());

		$this->row->addField(\Fields::select('parent_id')->values(\Page::pluck('title', 'id')->prepend(''))->selected($this->parent_id)->add());

		$this->row->addCol(6)
			->addSection(__('cms::general.images'))
			->addField(\Fields::file('thumbnail')->add());

		if($type !== 'external'){

			$this->row->addField(\Fields::file('banner')->add());
		}

		return $this->row;
	}

	/*public function repeaterTab(){

		return \Row::init()
			->addCol(12)
			->addSection(__('Repeater'))
			->addField(\Fields::repeater('sectors', [
				\Fields::text('title')->add(),
				\Fields::textarea('description')->add()
			]));
	}*/
}

