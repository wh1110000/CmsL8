<?php

namespace wh1110000\CmsL8\Http\Repositories\Website;

use wh1110000\CmsL8\Models\Presenters\ArchiveCategory;
use wh1110000\CmsL8\Http\Repositories\WebRepository;

/**
 * Class ArchiveCategoryRepository
 * @package Workhouse\Archives\Website\Repositories
 */

class ArchiveCategoryRepository extends WebRepository {

	public function __construct() {

		$this->model = new ArchiveCategory();

		parent::__construct();
	}
}