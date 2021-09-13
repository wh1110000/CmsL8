<?php

namespace wh1110000\CmsL8\Providers;

use Illuminate\Support\Facades\Blade;
use wh1110000\CmsL8\View\Components\CookiePolicy;
use wh1110000\CmsL8\View\Components\Modal;
use wh1110000\CmsL8\View\Components\Widget;

/**
 * Class ComponentsServiceProvider
 * @package Workhouse\Components\Providers
 */

class ComponentsServiceProvider extends AbstractServiceProvider {

	/**
	 *
	 */

	public function boot() {

		parent::boot();

		Blade::component('modal', Modal::class);

		Blade::component('cookie-policy', CookiePolicy::class);

		Blade::component('widget', Widget::class);
	}

	/**
	 *
	 */

	public function loadViews() {

		parent::loadViews();

		
		$this->loadViewsFrom( __DIR__ . '/../../resources/views/DataTable/', 'datatable' );
		$this->loadViewsFrom( __DIR__ . '/../../resources/views/CookiePolicy/', 'cookiePolicy' );
		$this->loadViewsFrom( __DIR__ . '/../../resources/views/Modal/', 'modal' );
		$this->loadViewsFrom( __DIR__ . '/../../resources/views/Widget/', 'widget' );


		//$this->loadViewsFrom( $this->dir . '/resources/views/blocks/', 'blocks' );
	}
}
