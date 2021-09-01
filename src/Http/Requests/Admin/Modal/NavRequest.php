<?php

namespace wh1110000\CmsL8\Http\Requests\Admin\Modal;

use wh1110000\CmsL8\Http\Requests\ModalRequest;

/**
 * Class NavRequest
 * @package Workhouse\Pages\Requests\Admin\Modal
 */

class NavRequest extends ModalRequest {

	/**
	 * @var array
	 */

	public $defaultRules = [
		'title' => ['required']
	];
}