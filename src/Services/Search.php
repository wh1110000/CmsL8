<?php

namespace wh1110000\CmsL8\Services;

use Illuminate\Support\Arr;

/**
 * Class Search
 * @package Workhouse\Cms\Helpers
 */

class Search extends \Spatie\Searchable\Search {

	/**
	 * @param string $modelClass
	 * @param array ...$attributes
	 *
	 * @return \Spatie\Searchable\Search
	 */

	public function registerModel($modelClass, ...$attributes): \Spatie\Searchable\Search {

		if (isset($attributes[0]) && is_callable($attributes[0])) {

			$attributes = $attributes[0];
		}

		if (is_array(Arr::get($attributes, 0))) {

			$attributes = $attributes[0];
		}

		$searchAspect = new ModelSearchAspect($modelClass, $attributes);

		$this->registerAspect($searchAspect);

		return $this;
	}

	/**
	 * @param \Spatie\Searchable\SearchAspect|string $searchAspect
	 *
	 * @return \Spatie\Searchable\Search
	 */

	public function registerAspect($searchAspect): \Spatie\Searchable\Search {

		if (is_string($searchAspect)) {

			$searchAspect = app($searchAspect);
		}

		$this->aspects[$searchAspect->getType()] = $searchAspect;

		return $this;
	}
}