<?php

namespace wh1110000\CmsL8\Models;

/**
 * Class Nav
 * @package Workhouse\Pages\Models
 */

class Nav extends BaseModel {

	/**
	 * @var array
	 */

	protected $fillable = [
		'title',
		'position'
	];

	protected $with = [
		'pages',
		//'slug',
		//'translations'
	];

	/**
	 * @var bool
	 */

	protected $hasSeo = false;

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */

	public function pages() {

		return $this->hasMany('\NavPage', 'nav_id')->orderBy('nav_order', 'ASC');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
	 */

	public function hasNotPermissions() {

		return $this->hasManyThrough('\PagePermission', '\NavPage', 'nav_id', 'page_id', 'id', 'id')->where('lang', '=', \App::getLocale());
	}
}