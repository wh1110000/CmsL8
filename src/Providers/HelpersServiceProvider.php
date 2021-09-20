<?php

namespace wh1110000\CmsL8\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use wh1110000\CmsL8\Services\Nav\Admin;
use wh1110000\CmsL8\Http\Controllers\Html\Button;
use wh1110000\CmsL8\Http\Controllers\DataTable;
use wh1110000\CmsL8\Http\Controllers\Html\Fields;
use wh1110000\CmsL8\Services\Nav\Website;
use wh1110000\CmsL8\Http\Controllers\Html\Admin\Row;
use wh1110000\CmsL8\View\Components\Modal;
use Doctrine\Inflector\InflectorFactory;
use Doctrine\Inflector\Rules\Patterns;
use Doctrine\Inflector\Rules\Ruleset;
use Doctrine\Inflector\Rules\Substitution;
use Doctrine\Inflector\Rules\Substitutions;
use Doctrine\Inflector\Rules\Transformations;
use Doctrine\Inflector\Rules\Word;

/**
 * Class HelpersServiceProvider
 * @package Workhouse\Helpers
 */

class HelpersServiceProvider extends ServiceProvider {

	/**
	 *
	 */

	public function register() {

		$this->registerDataTable();

		$this->registerRow();

		$this->registerFields();

		$this->registerButton();

		$this->registerNavigation();

		$this->registerInflector();


	}

	/**
	 *
	 */

	public function boot(){

		/**/

		$this->loadViews();

		/*$inflector = InflectorFactory::create()
			->withSingularRules(
                 new Ruleset(
                     new Transformations(),
                     new Patterns(),
                     new Substitutions(new Su.bstitution(new Word('media'), new Word('media')))
                 )
			)
			->withPluralRules(
				new Ruleset(
                     new Transformations(),
                     new Patterns(),
                     new Substitutions(
                         new Substitution(new Word('media'), new Word('media'))
                     )
                 )
             )
             ->build();*/


		/*Inflector::rules('singular', [

			'irregular' => array(
				'media'      => 'media',
				'medium'      => 'medium'
			)
		] );

		Inflector::rules('plural', [

			'irregular' => array(
				'media'      => 'media',
				'medium'      => 'medium'
			)
		]);*/
	}

	/**
	 *
	 */

	public function registerDataTable(){

		$this->app->singleton('DataTable', function () {

			return new DataTable\DataTable();
		});
	}

	/**
	 *
	 */

	public function registerRow(){

		$this->app->bind('Row', function() {

			return new Row();
		});
	}

	/**
	 *
	 */

	public function registerFields(){

		$this->app->bind('Fields', function() {

			return new Fields();
		});
	}

	/**
	 *
	 */

	public function registerButton(){

		$this->app->singleton('Button', function($app) {

			return new Button($app['url'], $app['view']);
		});
	}

	/**
	 *
	 */

	public function registerNavigation(){

		$this->app->singleton('Navigation', function() {

			$route = \Request()->route();

			if(!is_null($route) && (\Str::startsWith($route->getName(), 'admin.'))){

				$navigation = new Admin();

			} else {

				$navigation = new Website();
			}

			return $navigation;

		});
	}

	public function registerInflector(){

		$this->app->bind('DoctrineInflector', function() {

			return InflectorFactory::create()
			                ->withSingularRules(
				                new Ruleset(
					                new Transformations(),
					                new Patterns(),
					                new Substitutions(
						                new Substitution( new Word( 'media' ), new Word( 'Media' ) )
					                )
				                )
			                )
			                ->withPluralRules(
				                new Ruleset(
					                new Transformations(),
					                new Patterns(),
					                new Substitutions(
						                new Substitution( new Word( 'media' ), new Word( 'media' ) )
					                )
				                )
			                )
			                ->build();
			});


	}

	/**
	 *
	 */

	public function loadViews(){

		$this->loadViewsFrom(__DIR__.'/resources/views/DataTable', 'datatable');
		$this->loadViewsFrom(__DIR__.'/resources/views/Modal', 'modal');
	}

	/**
	 *
	 */

	public function loadPublish(){

		$this->publishes([
			__DIR__ . '/resources/views' => resource_path('views/vendor/datatable')
		], 'datatable-view');
	}


}
