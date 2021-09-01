<?php

namespace wh1110000\CmsL8\Models\Presenters;

/**
 * Class Media
 * @package Workhouse\Media\Presenters
 */

class Media extends \wh1110000\CmsL8\Models\Media {

	/**
	 * @return mixed
	 */

	public function defaultTab() {

		$row = \Row::init()
		           ->addCol(12)
		           ->addSection()
		           ->addField( \Fields::text('alt')->add());

		return $row;
	}
}