<?php

namespace wh1110000\CmsL8\Http\Requests\Admin;

use wh1110000\CmsL8\Requests\GeneralRequest;

/**
 * Class ShopRequest
 * @package Workhouse\Shops\Requests
 */

class ShopRequest extends GeneralRequest {

	/**
	 * @var array
	 */

	public $defaultRules = [
		'shop_category_id' => ['nullable','integer'],
		'name' => ['required','string','max:191'],
		'short_description' => ['nullable','string'],
		'description' => ['nullable','string'],
		'manager_name' => ['nullable', 'email', 'max:100'],
		'phone' => ['nullable', 'string', 'max:100'],
		'email' => ['nullable', 'email', 'max:100'],
		'fax' => ['nullable', 'string', 'max:100'],
		'url_protocol' => ['nullable','in:http,https'],
		'url' => ['nullable','string','max:191'],
		'street' => ['nullable','string','max:191'],
		'street_extra' => ['nullable','string','max:191'],
		'postcode' => ['nullable','string','max:20'],
		'city' => ['nullable','string','max:191'],
		'country_id' => ['nullable'],
		'latitude' => ['nullable', 'numeric'],
		'longitude' => ['nullable', 'numeric'],
		'department' => ['boolean'],
	];

	/**
	 * @return array
	 */

	public function rules() {

		$category = new \ShopCategory;
		$country = new \Country;

		parent::rules();

		$this->defaultRules['shop_category_id'][] = 'exists:'.$category->getTable().',id';

		$this->defaultRules['country_id'][] = 'exists:'.$country->getTable().',id';

		return $this->defaultRules;
	}
}