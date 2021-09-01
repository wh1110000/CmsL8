<?php

namespace wh1110000\CmsL8\Traits;

use Spatie\Searchable\SearchResult;

/**
 * Trait Search
 * @package Workhouse\Cms\Traits
 */

trait Search {

	public function getSearchResult(): SearchResult {

		$routes = Route::getRoutes();

		if ( in_array( $this->getPostType(), $routes ) ) {

			$route = route( $this->getPostType() );

		} else if ( in_array( $this->getNamespace() . '.show', $routes ) ) {

			$route = route( $this->getNamespace() . '.show', $this );

		} else {

			$route = route( 'page.show', $this->getLink() );
		}

		return new SearchResult( $this, ( $this->title ?? $this->name ) ?? '', $route );
	}
}