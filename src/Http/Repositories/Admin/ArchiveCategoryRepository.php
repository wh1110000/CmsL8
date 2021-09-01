<?php

namespace wh1110000\CmsL8\Http\Repositories\Admin;

use wh1110000\CmsL8\Models\Presenters\ArchiveCategory;
use wh1110000\CmsL8\Http\Repositories\AdminRepository;

class ArchiveCategoryRepository extends AdminRepository {

	public function __construct() {

		$this->model = new ArchiveCategory();
	}
}