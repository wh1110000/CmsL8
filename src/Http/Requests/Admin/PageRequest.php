<?php

namespace wh1110000\CmsL8\Http\Requests\Admin;

use wh1110000\CmsL8\Http\Requests\GeneralRequest;

/**
 * Class PageRequest
 * @package Workhouse\Pages\Admin\Requests
 */

class PageRequest extends GeneralRequest {

	/**
	 * @var array
	 */

	public $defaultRules = [
		'title' => ['required','string','max:191'],
		'content' => ['required'],
	];

	/**
	 * @return array
	 */

	public function rules() {

		if($this->isPageType('external')){

			$this->defaultRules['content'][] = 'url';

		} elseif($this->isPageType('global')){

			unset($this->defaultRules['content']);
		}

		return parent::rules();
	}

	/**
	 * @param $type
	 *
	 * @return bool
	 */

	private function isPageType($type){

		$page = optional(request('page'));

		$pageExists = optional($page)->exists();

		if(($pageExists && $page->isType($type)) || (!$pageExists && request('type') == $type)){

			return true;
		}

		return false;
	}
}