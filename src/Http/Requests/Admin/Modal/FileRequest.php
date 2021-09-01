<?php

namespace wh1110000\CmsL8\Http\Requests\Admin\Modal;

use wh1110000\CmsL8\Http\Requests\ModalRequest;

/**
 * Class FileRequest
 * @package Workhouse\Media\Requests\Admin\Modal
 */

class FileRequest extends ModalRequest {

	/**
	 * @var array
	 */

	public $defaultRules = [
		'alt'  => ['nullable', 'string', 'max:191']
	];

	/**
	 * @return array|mixed
	 */

	public function rules() {

		return $this->defaultRules;
	}
}