<?php

namespace wh1110000\CmsL8\Traits;

use Illuminate\Support\Str;
use wh1110000\CmsL8\Http\Controllers\Tab;
use wh1110000\CmsL8\Services\Route;

/**
 * Trait ModelHelper
 * @package Workhouse\Cms\Traits
 */

trait ModelHelper {

	/**
	 * @var
	 */

	protected $namespace;

	/**
	 * @var
	 */

	protected $prefix = null;

	/**
	 * @var
	 */

	protected $postType;

	/**
	 * @var
	 */

	protected $modelName;

	/**
	 * @var
	 */

	protected $postTypeLabel;

	/**
	 * @var
	 */

	protected $table;

	/**
	 * @param null $type
	 */

	/**
	 * @return mixed
	 */

	public function getNamespace(){

		return $this->namespace;
	}

	/**
	 * @return mixed
	 */

	public function getPrefix(){

		return $this->prefix;
	}

	/**
	 * @return mixed
	 */

	public function getPostType(){

		return $this->postType;
	}

	/**
	 * @return mixed
	 */

	public function getModelName(){

		return $this->modelName;
	}

	/**
	 * @return mixed
	 */

	public function getPostTypeLabel(){

		return $this->postTypeLabel;
	}

	/**
	 * @return bool
	 */



	/**
	 * @return bool
	 */



	/**
	 * @return Tab
	 */

	public function form(){

		$methods = get_class_methods($this);

		$formTabs = array_filter($methods, function ($value){

			return Str::endsWith($value, 'Tab');
		});


		$tabs = new Tab();

		foreach ($formTabs as $tab){

			$fields = $this->{$tab}();

			$tabs->addTab($tab, $fields);
		}

		return $tabs;
	}

	/**
	 * @return mixed
	 */

	public static function getTableName()
	{
		return with(new static)->getTable();
	}
}
