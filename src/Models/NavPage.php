<?php

namespace wh1110000\CmsL8\Models;

use wh1110000\CmsL8\Models\BaseModel;

/**
 * Class NavPage
 * @package Workhouse\Pages\Models
 */

class NavPage extends BaseModel {

	/**
	 * @var string
	 */

	protected $table = 'nav_page';

	/**
	 * @var string
	 */

	public $hasSeo = false;

	/**
	 * @var array
	 */

	public $fillable = [
		'content_id',
		'nav_id',
		'title',
		'type',
		'nav_order',
	];

	/**
	 * @var array
	 */

	protected $with = [
		'default'
	];

	/**
	 * @var bool
	 */

	public $timestamps = false;

	/**
	 * @param $type
	 *
	 * @return bool
	 */

	public function isType($type){

		return $this->type === $type;
	}

	/**
	 * @return mixed
	 */

	public function getTitle(){

		return $this->title ?: optional($this->default)->getTitle();
	}

	/**
	 * @return mixed
	 */

	public function getType(){

		return $this->type ?? $this->default->getType();
	}

	/**
	 * @return mixed
	 */

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */

	public function default() {

		return $this->hasOne('\Page', 'id', 'page_id');
	}
}