<?php

namespace wh1110000\CmsL8\Traits;

use Illuminate\Support\Str;

/**
 * Trait BindsDynamically
 * @package Workhouse\Archives\Traits
 */

trait BindsDynamically {

	/**
	 * @param string $connection
	 * @param string $table
	 */

	public function bind(string $connection, string $table) {

		$this->setConnection($connection);

		$this->setTable($table);
	}

	/**
	 * @param array $attributes
	 * @param bool $exists
	 *
	 * @return mixed
	 */

	public function newInstance($attributes = [], $exists = false) {

		$attributes = Str::startsWith(get_called_class(), ['Workhouse\Archives'] ) ? array_merge($attributes, ['type' => $this->getModelName()]) : $attributes;

		$model = parent::newInstance($attributes, $exists);

		$model->table = $this->table;

		return $model;
	}


	/**
	 * @param $class
	 *
	 * @return mixed
	 */

	protected function newRelatedInstance($class) {

		if(is_object($class)){

			return tap(new $class, function ($instance) use ($class) {

				if (! $instance->getConnectionName()) {

					$instance->setConnection($this->connection);

					$instance->setTable($class->getTable());
				}
			});
		}
	}
}