<?php

namespace wh1110000\CmsL8\Providers;

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

/**
 * Class ContactServiceProvider
 * @package Workhouse\Contact\Providers
 */

class ContactServiceProvider extends AbstractServiceProvider {

	/**
	 *
	 */

	public function loadPublish() {

		parent::loadPublish();

		$this->loadViewsFrom($this->dir('/resources/views/emails/'), 'emails');
	}

	/**
	 *
	 */

	public function loadBreadcrumb() {

		Breadcrumbs::for('contact.index', function ($trail) {
			$trail->push(  __('general.home'), route('page.homepage'));
			$trail->push(  __('general.contact'), route('contact.index'));
		});

	}

}
