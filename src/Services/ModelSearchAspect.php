<?php

namespace wh1110000\CmsL8\Services;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Spatie\Searchable\Exceptions\InvalidModelSearchAspect;
use Spatie\Searchable\SearchableAttribute;

/**
 * Class ModelSearchAspect
 * @package Workhouse\Cms\Helpers
 */

class ModelSearchAspect extends \Spatie\Searchable\ModelSearchAspect {


	/**
	 * ModelSearchAspect constructor.
	 *
	 * @param $model
	 * @param array $attributes
	 */

	public function __construct($model, $attributes = []) {

		$this->model = $model;

		if (is_array($attributes)) {

			$this->attributes = SearchableAttribute::createMany($attributes);

			return;
		}

		if (is_string($attributes)) {

			$this->attributes = SearchableAttribute::create($attributes);

			return;
		}

		if (is_callable($attributes)) {

			$callable = $attributes;

			$callable($this);

			return;
		}
	}

	/**
	 * @return string
	 */

	public function getType(): string {

		if (isset(static::$searchType)) {

			return static::$searchType;
		}

		$type = $this->model->getTable();

		$type = Str::snake(Str::plural($type));

		return ucwords(Str::plural(str_replace('-', ' ', str_replace('_', ' ',$type))));
	}

	/**
	 * @param string $term
	 * @param User|null $user
	 *
	 * @return Collection
	 * @throws InvalidModelSearchAspect
	 */

	public function getResults(string $term, User $user = null): Collection {

		if (empty($this->attributes)) {

			throw InvalidModelSearchAspect::noSearchableAttributes($this->model);
		}

		$query = $this->model->newQuery();

		foreach ($this->callsToForward as $method => $parameters) {
			$this->forwardCallTo($query, $method, $parameters);
		}

		$this->addSearchConditions($query, $term);

		return $query->get();
	}
}
