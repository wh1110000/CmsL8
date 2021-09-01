<?php

namespace wh1110000\CmsL8\Traits;

use Illuminate\Support\Str;

/**
 * Trait Content
 * @package Workhouse\Cms\Traits
 */

trait Content {

	/**
	 * @return mixed
	 */

	public function getTitle(){

		return $this->title;
	}

	/**
	 * @return mixed
	 */

	public function getName(){

		return $this->name ?? $this->getTitle();
	}

	/**
	 * @return mixed
	 */

	public function getExcerpt(){

		return strip_tags($this->excerpt ?: $this->getShortDescription());
	}

	/**
	 * @param int $limit
	 * @param string $end
	 *
	 * @return string
	 */

	public function getShortDescription($limit = 500, $end = '...') {

		return strip_tags($this->short_description) ?: Str::limit(strip_tags($this->description), $limit, $end);
	}

	/**
	 * @return mixed
	 */

	public function getDescription(){

		return $this->content ?? $this->description;
	}

	/**
	 * @alias getDescription
	 *
	 * @return mixed
	 */

	public function getContent(){

		return $this->getDescription();
	}
}
