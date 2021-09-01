<?php

namespace wh1110000\CmsL8\Models\Presenters;

/**
 * Class Nav
 * @package Workhouse\Pages\Presenters
 */

class Nav extends \wh1110000\CmsL8\Models\Nav {

	/**
	 * @return mixed
	 */

	public function defaultTab() {

		$row = \Row::init()
			->addCol(12)
			->addField(\Fields::text('title')->add());

		return $row;
	}

	/**
	 * @return mixed
	 */

	public function megaNavTab() {

		$navs = \Nav::where('id', '<>', $this->getId())->pluck('title', 'id');

		$row = \Row::init()
			->addCol(12)
			->addField(\Fields::multiselect('SubNav')->values($navs)->add());

		return $row;
	}
}