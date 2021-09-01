<?php

namespace wh1110000\CmsL8\Models\Presenters;

/**
 * Class NavPage
 * @package Workhouse\Pages\Presenters
 */

class NavPage extends \wh1110000\CmsL8\Models\NavPage {

	/**
	 * @var array
	 */

	protected $translatable = [
		'title',
		'content'
	];

	/**
	 * @return mixed
	 */

	public function defaultTab() {

		$row = \Row::init()
			->addCol(12)
			->addField(\Fields::text('title')->value($this->getTitle())->add());

		return $row;
	}

	/**
	 * @return mixed
	 */

	/*public function attributesTab() {

		$row = \Row::init()
			->addCol(12)
			->addField(\Fields::text('class')->add());

		return $row;
	}*/
}