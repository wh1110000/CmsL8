<?php

namespace wh1110000\CmsL8\Services\Nav;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Menu;

/**
 * Class Admin
 * @package Workhouse\Cms\Helpers\Menu
 */

class Admin {

	/**
	 * @return Menu
	 */

	public function init(){

		$menu = Menu::new()->addClass( 'list-unstyled' );

		/*MAIN MENU*/

		$menu->html( '<h5 class="sidenav-heading">'.__('cms::general.main').'</h5>' )
			->route( 'admin.dashboard.index', '<i class="fas fa-home"></i> '.__('cms::general.dashboard'));

		if(class_exists('Workhouse\Contact\Controllers\Admin\EmailController')) {

			$menu->route( 'admin.email.index', '<i class="fas fa-inbox"></i> ' . __( 'contact::general.inbox' ), ['type' => 'inbox'] );
		}

		if(class_exists('Workhouse\Users\Controllers\Admin\UserController')){

			$menu->html( '<h5 class="sidenav-heading">' . __( 'users::general.users' ) . '</h5>' )
			     ->submenu( Link::to( '#usersSubMenu', '<i class="fas fa-users-cog"></i> ' . __( 'users::general.users' ) )
			                    ->setAttribute( 'aria-expanded', $this->isRoute( [
				                    'user.',
				                    'permission.',
				                    'role.'
			                    ] ) ? "true" : "false" )
			                    ->setAttribute( 'data-toggle', 'collapse' ), function ( Menu $menu ) {
				     $menu->setAttribute( 'id', 'usersSubMenu' )
				          ->addClass( 'list-unstyled' )
				          ->addClass( 'collapse' )
				          ->addClass( $this->isRoute([ 'user.', 'permission.', 'role.' ] ) ? " show " : "" )
				          ->route( 'admin.user.index', '<i class="fas fa-user-shield"></i> ' . __( 'users::general.users' ) )
				          ->route( 'admin.role.index', '<i class="fas fa-tag"></i> ' . __( 'permissions::general.roles' ), ['guard' => 'web'] )
				          ->route( 'admin.permission.index', '<i class="fas fa-unlock-alt"></i> ' . __( 'permissions::general.permissions' ) , ['guard' => 'web']);
			     } );

			//$menu->route( 'admin.user.index', '<i class="fas fa-users"></i> '.__('users::general.users'));
		}

		if(class_exists('Workhouse\Newsletter\Controllers\Admin\NewsletterSubscriberController')){

			$menu->route( 'admin.newsletter-subscriber.index', '<i class="fas fa-newspaper"></i> '.__('newsletter::general.newsletter'));
		}

		//->routeIfCan('Show Users', 'admin.users.index', '<i class="fas fa-users"></i> '.__('cms::general.users'));

		/*SITE DATA MENU*/

		$menu->html( '<h5 class="sidenav-heading">'.__('cms::general.site_data').'</h5>' )
			->route( 'admin.page.index', '<i class="far fa-copy"></i> '.__('pages::general.pages') );

		if(class_exists('Workhouse\Faqs\Controllers\Admin\FaqController')){

			$menu->submenu( Link::to( '#faqsSubMenu', '<i class="fas fa-question"></i> '.(__( 'faqs::general.faqs' )) )
			                    ->setAttribute( 'aria-expanded', $this->isRoute( [ 'faq' ] ) ? "true" : "false" )
			                    ->setAttribute( 'data-toggle', 'collapse' ), function ( Menu $menu ) {
				$menu->setAttribute( 'id', 'faqsSubMenu' )
				     ->addClass( 'collapse' )
				     ->addClass( 'list-unstyled' )
				     ->addClass( $this->isRoute( [ 'faq' ] ) ? " show " : "" )
				     ->route( 'admin.faq.index', '<i class="fas fa-question"></i> ' . __( 'faqs::general.faqs' ) )
				     ->route( 'admin.faq-category.index', '<i class="fas fa-folder-open"></i> ' . __('cms::general.categories') );
			});
		}

		if(class_exists('Workhouse\Shops\Controllers\Admin\ShopController')) {

			$menu->submenu( Link::to( '#shopsSubMenu', '<i class="fas fa-building"></i> '.(__( 'shops::general.shops' )) )
			                    ->setAttribute( 'aria-expanded', $this->isRoute( [ 'shop' ] ) ? "true" : "false" )
			                    ->setAttribute( 'data-toggle', 'collapse' ), function ( Menu $menu ) {
				$menu->setAttribute( 'id', 'shopsSubMenu' )
				     ->addClass( 'collapse' )
				     ->addClass( 'list-unstyled' )
				     ->addClass( $this->isRoute( [ 'shop' ] ) ? " show " : "" )
				     ->route( 'admin.shop.index', '<i class="fas fa-shopping-cart"></i> ' . __( 'shops::general.shops' ) )
				     ->route( 'admin.shop-category.index', '<i class="fas fa-folder-open"></i> ' . __('cms::general.categories') );
			} );
		}

		if(class_exists('Workhouse\Teams\Controllers\Admin\TeamController')) {

			$menu->submenu( Link::to( '#teamsSubMenu', '<i class="fas fa-user-plus"></i> '.(__( 'teams::general.teams' )) )
			                    ->setAttribute( 'aria-expanded', $this->isRoute( [ 'teams.' ] ) ? "true" : "false" )
			                    ->setAttribute( 'data-toggle', 'collapse' ), function ( Menu $menu ) {
				$menu->setAttribute( 'id', 'teamsSubMenu' )
				     ->addClass( 'collapse' )
				     ->addClass( 'list-unstyled' )
				     ->addClass( $this->isRoute( [ 'team.' ] ) ? " show " : "" )
				     ->route( 'admin.team.index', '<i class="fas fa-sitemap"></i> ' . __( 'teams::general.teams' ) )
				     ->route( 'admin.team-member.index', '<i class="fas fa-users"></i> ' . __('teams::general.team-members') )
				     ->route( 'admin.team-role.index', '<i class="fas fa-users-cog"></i> ' . __('teams::general.team-roles') );
			} );
		}

		if(class_exists('Workhouse\Testimonials\Controllers\Admin\TestimonialController')){

			$menu->route( 'admin.testimonial.index', '<i class="fas fa-quote-right"></i> '.__('testimonials::general.testimonials'));
		}

		if(class_exists('\Workhouse\Articles\Providers\ArticlesServiceProvider')){

			foreach(\Workhouse\Articles\Providers\ArticlesServiceProvider::getArchives() as $slug => $postType) {

				$archive = $slug;

				$slug = app('DoctrineInflector')->singularize($slug);

				$menu->submenu( Link::to( '#packagesSubMenu' . $archive, '<i class="fas fa-clipboard"></i> '.(ucwords(str_replace('-', ' ', $archive))))
	                ->setAttribute( 'aria-expanded', $this->isRoute([$slug.'.']) ? "true" : "false" )
	                ->setAttribute( 'data-toggle', 'collapse' ), function ( Menu $menu ) use ($archive, $slug) {
						$menu->setAttribute( 'id', 'packagesSubMenu' . $archive )
						     ->addClass( 'collapse' )
						     ->addClass( 'list-unstyled' )
						     ->addClass(  $this->isRoute([$slug.'.']) ? " show " : "" )
						     ->route( 'admin.' . $slug . '.index', '<i class="fas fa-file-alt"></i> '. __('Posts'))
						     ->route( 'admin.' . $slug . '-category.index', '<i class="fas fa-folder-open"></i> '.__('cms::general.categories'));
				});
			}
		}
		if(class_exists('Workhouse\Products\Controllers\Admin\ProductController')) {

			$menu->submenu( Link::to( '#productsSubMenu', '<i class="fas fa-shopping-cart"></i> Products' )
                ->setAttribute( 'aria-expanded', $this->isRoute( [ 'products.' ] ) ? "true" : "false" )
                ->setAttribute( 'data-toggle', 'collapse' ), function ( Menu $menu ) {
					$menu->setAttribute( 'id', 'productsSubMenu' )
					     ->addClass( 'collapse' )
					     ->addClass( 'list-unstyled' )
					     ->addClass( $this->isRoute( [ 'product.' ] ) ? " show " : "" )
					     ->route( 'admin.product.index', '<i class="fas fa-shopping-cart"></i> ' . __( 'products::general.products' ) )
					     ->route( 'admin.product-category.index', '<i class="fas fa-folder-open"></i> ' . __('cms::general.categories') );
			} );
		}


		$menu->route( 'admin.media.index', '<i class="fas fa-folder-plus"></i> '.__('media::general.media'));

		/*SETTINGS MENU*/

		if(!auth('administrator')->user()->hasRole('Editor')){

		$menu->html( '<h5 class="sidenav-heading">' . __( 'settings::general.settings' ) .' </h5>' )
		     ->submenu( Link::to( '#settingsSubMenu', '<i class="fas fa-cogs"></i> ' . __( 'settings::general.settings' ) )
		                    ->setAttribute( 'aria-expanded', $this->isRoute( [
			                    'settings.',
			                    'social_media.',
			                    'menus.',
			                    'sliders.'
		                    ] ) ? "true" : "false" )
		                    ->setAttribute( 'data-toggle', 'collapse' ), function ( Menu $menu ) {
			     $menu->setAttribute( 'id', 'settingsSubMenu' )
			          ->addClass( 'collapse' )
			          ->addClass( 'list-unstyled' )
			          ->addClass( $this->isRoute( [ 'setting.', 'social_media.', 'menu.' ] ) ? " show " : "" )
			          ->route( 'admin.setting.show', '<i class="fas fa-cog"></i> ' . ( __( 'settings::general.settings' ) ) )
			          ->route( 'admin.nav.index', '<i class="fas fa-bars"></i> ' . __( 'cms::general.menus' ) )
			          ->route( 'admin.social-media.index', '<i class="fas fa-share-alt"></i> ' . __( 'socialMedia::general.social_media' ) );
		     } )
		     ->submenu( Link::to( '#multilanguageSubMenu', '<i class="fas fa-flag"></i> ' . __( 'multilanguage::general.multilanguage' ) )
		                    ->setAttribute( 'aria-expanded', $this->isRoute( [
			                    'languages.',
			                    'countries.'
		                    ] ) ? "true" : "false" )
		                    ->setAttribute( 'data-toggle', 'collapse' ), function ( Menu $menu ) {
			     $menu->setAttribute( 'id', 'multilanguageSubMenu' )
			          ->addClass( 'collapse' )
			          ->addClass( 'list-unstyled' )
			          ->addClass( $this->isRoute( [ 'language.\', \'country.' ] ) ? " show " : "" );

			        if(config('app.translationby') == 'country'){

				        $menu->route( 'admin.country.index', '<i class="fas fa-globe-europe"></i> ' . __( 'multilanguage::general.countries' ) );

			        } else {

			        	$menu->route( 'admin.language.index', '<i class="fas fa-language"></i> ' . __( 'multilanguage::general.languages' ) );
			        }

		     } );

			/*ADMIN ZONE MENU*/

			$menu->html( '<h5 class="sidenav-heading">' . __( 'cms::general.admin_zone' ) . '</h5>' )
			     ->submenu( Link::to( '#administratorsSubMenu', '<i class="fas fa-users-cog"></i> ' . __( 'administrators::general.accounts' ) )
			                    ->setAttribute( 'aria-expanded', $this->isRoute( [
				                    'administrator.',
				                    'permission.',
				                    'role.'
			                    ] ) ? "true" : "false" )
			                    ->setAttribute( 'data-toggle', 'collapse' ), function ( Menu $menu ) {
				     $menu->setAttribute( 'id', 'administratorsSubMenu' )
				          ->addClass( 'list-unstyled' )
				          ->addClass( 'collapse' )
				          ->addClass( $this->isRoute( [ 'administrator.', 'permission.', 'role.' ] ) ? " show " : "" )
				          ->route( 'admin.administrator.index', '<i class="fas fa-user-shield"></i> ' . __( 'administrators::general.administrators' ) )
				          ->route( 'admin.role.index', '<i class="fas fa-tag"></i> ' . __( 'permissions::general.roles' ), ['guard' => 'administrator'] )
				          ->route( 'admin.permission.index', '<i class="fas fa-unlock-alt"></i> ' . __( 'permissions::general.permissions' ), ['guard' => 'administrator'] );
			     } );
		}

		if(auth('administrator')->user()->hasRole('Developer')){

		    $menu->html('<h5 class="sidenav-heading">For Developers</h5>')
				 ->route( 'admin.documentation.index', '<i class="fas fa-book"></i> '.__('cms::general.documentation'));
        }

		return $menu;
	}

	/**
	 * @param array $routes
	 *
	 * @return bool
	 */

	public function isRoute($routes = []){

		return Str::contains( Route::currentRouteName(), $routes);
	}
}
