<?php

namespace wh1110000\CmsL8\Providers;

use Illuminate\Support\Facades\Blade;
use wh11100001906\SocialMedia\Components\SocialMedia;
use wh1110000\CmsL8\Providers\AbstractServiceProvider;

/**
 * Class SocialMediaServiceProvider
 * @package Workhouse\SocialMedia\Providers
 */

class SocialMediaServiceProvider extends AbstractServiceProvider {

	/**
	 *
	 */

	public function register() {

		parent::register();

		$this->app->singleton('socialMedia', function(){

			return \SocialMedia::orderBy('order', 'asc')->get();
		});
	}

	/**
	 *
	 */

	public function boot() {

		parent::boot();

		Blade::component('social-media', SocialMedia::class);
	}

	/**
	 *
	 */

	public function loadViews() {

		parent::loadViews();

		$this->loadViewsFrom( $this->dir('resources/views/components/social-media/'), 'socialMedia' );
	}
}
