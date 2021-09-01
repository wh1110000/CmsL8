<?php

namespace wh11100001906\CmsL8\Providers;

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use wh1110000\CmsL8\Providers\AbstractServiceProvider;

/**
 * Class ShopsServiceProvider
 * @package Workhouse\Shops\Providers
 */

class ShopsServiceProvider extends AbstractServiceProvider {

	/**
	 *
	 */

	public function loadConfigs() {

		parent::loadConfigs();

		$this->mergeConfigFrom( $this->dir('/config/shop.php'), 'shop');
	}

	/**
	 *
	 */

	public function loadBreadcrumb() {

		/*Breadcrumbs::for('shop.index', function ($trail) {
			$trail->push(  __('general.home'), route('page.homepage'));
			$trail->push(  __('shops::general.shops'), route('shop.index'));
		});*/

		/*Breadcrumbs::for('shop.show', function ($trail, $category) {
			$category = \ShopCategory::where( 'link', $category)->first();
			$trail->push(  __('general.home'), route('page.homepage'));
			$trail->push(  __('shops::general.shops'), route('shop.index'));
			$trail->push(  $category->getTitle(), route('shop.show', $category));
		});*/
	}
}

