<?php

namespace wh1110000\CmsL8\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Mockery\Exception;
use Symfony\Component\Finder\Finder;
use wh1110000\CmsL8\Observers\ModelObserver;
use wh1110000\CmsL8\Middleware\defaultLocale;

/**
 * Class AbstractServiceProvider
 * @package Workhouse\Cms\Providers
 */

abstract class AbstractServiceProvider extends ServiceProvider {

	private $protectedModels = [
		'BaseModel',
		'Lang',
		'Property',
		'Seo'
	];

	/**
	 * @var string
	 */

	protected $package;

	/**
	 * @var string
	 */

	protected $dir;

	/**
	 * @var
	 */

	protected $namespace;


	/**
	 * @var
	 */

	protected  $divider = '/';

	/**
	 *
	 */

	public function register() {

		$this->loadConfigs();

		$this->loadModels();

		$this->bootSettings();
	}

	/**
	 *
	 */

	public function boot() {

		Relation::$morphMap = array_change_key_case(config('models'));

		$this->loadMigrations();

		$this->loadSeeds();

		$this->loadAssets();

		$this->loadMiddlewares();

		$this->loadRoutes();

		$this->loadViews();

		$this->loadTranslations();

		$this->loadCommands();

		$this->loadPublish();

		$this->loadBreadcrumb();


		$this->bootObservers();
	}

	/**
	 * AbstractServiceProvider constructor.
	 *
	 * @param \Illuminate\Contracts\Foundation\Application $app
	 */

	public function __construct(\Illuminate\Contracts\Foundation\Application $app ) {

		parent::__construct( $app );

		$reflector = new \ReflectionClass(get_called_class());

		$dirname = dirname($reflector->getFileName());

		if(!Str::contains($dirname, $this->divider)){

			$dirname = str_replace('\\', '/', $dirname);

			//$this->divider = '\\';
		}

		$this->dir = Str::beforeLast($dirname, $this->divider.'app'.$this->divider);

		$this->namespace = Str::beforeLast($reflector->getNamespaceName(), '\\Providers');

		if(!$this->package){

			$this->package = lcfirst(implode('', array_filter(preg_split('/(?=[A-Z])/', Str::after($this->namespace, '\\')))));
		}

		if($this->package == 'archives') {

			$this->namespace = Str::beforeLast(config( 'general.controller_namespace' ), '\\');
		}
	}

	/**
	 *
	 */

	protected function dir($path, $dirPrepend = true){

		$dir = '';

		if($dirPrepend){

			$dir = $this->dir;
		}

		return str_replace($this->divider.$this->divider, $this->divider, $dir . $this->divider . str_replace('\\', $this->divider, $path));
	}

	public function loadConfigs(){

		$configPath = $this->dir('/config/');

		if(file_exists($configPath)){

			$configs = Finder::create()->in($this->dir('/config/'))->name('*.php');

			foreach($configs as $config){

				$namespace = str_replace('\\', '.', Str::lower(Str::beforeLast($config->getRelativePathname(), '.')));

				if(Str::startsWith($namespace, 'admin')){

					$namespace = Str::after($namespace, 'admin.');
				}

				$this->mergeConfigFrom($config->getPathname(), $namespace);
			}
		}
	}

	/**
	 *
	 */

	public function loadModels(){

		$loader = AliasLoader::getInstance();

		$models = [];

		foreach ( $this->getModels() as $model ) {

			if($class = $this->getModelNamespace( $model )){

				$models[$model] = $class;

				$loader->alias($model, $class);

			}
		}

		config(['models' => array_merge(config('models') ?? [], $models)]);
	}

	/**
	 *
	 */

	public function loadMiddlewares(){

	}

	/**
	 *
	 */

	public function loadViews(){

		foreach (['admin', 'website', 'blocks', 'components'] as $namespace){

			if(file_exists($viewPath = $this->dir('/resources/views/'.$namespace.'/'))){

				$views = Finder::create()->in( $viewPath )->name( '*.php' );

				foreach ( $views as $view ) {

					$path = $view->getPath();

					$this->loadViewsFrom( $path, ( $namespace == 'admin' && ! Str::endsWith( $path, '/admin' ) ) && Str::contains( $path, [ 'admin' ] ) ? $namespace . '.' . basename( $path ) : basename( $path ) );
				}
			}
		}
	}

	/**
	 *
	 */

	public function loadTranslations(){

		$this->loadTranslationsFrom($this->dir('/resources/lang'), $this->package);
	}

	/**
	 *
	 */

	public function loadMigrations(){

		$this->loadMigrationsFrom($this->dir('/database/migrations'));
	}

	/**
	 * @todo
	 */

	public function loadSeeds(){

		return;

		$path = $this->dir('/database/seeds');

		if(file_exists($path)) {

			$files = Finder::create()->in( $path )->name( '*.php' );

			foreach ( $files as $file ) {

				$seed = $this->namespace . '\\Database\\Seeder\\' . class_basename( substr( $file->getRelativePathname(), 0, - 4 ) );

				Artisan::call( 'db:seed', [ '--class' => $seed, '--force' => '' ] );
			}
		}
	}

	/**
	 *
	 */

	public function loadPublish(){

		$this->publishes([
			$this->dir('/resources/views/website/'.$this->package) => resource_path($this->dir('views/vendor/'.$this->package, false))
		], $this->package);
	}

	/**
	 * @param $name
	 *
	 * @return Exception|string
	 */

	public function getModelNamespace($name) {

		foreach ([
			config( 'general.model_namespace' ),
			$this->namespace . '\\Presenters\\',
			$this->namespace . '\\Models\\'
		] as $_namespace ) {

			if (class_exists($model = Str::finish($_namespace, '\\' ) . $name ) ) {

				return $model;
			}
		}

		return new Exception('Model '.$name.' not exists');
	}

	/**
	 * @param null $path
	 *
	 * @return array
	 */

	public function getModels($path = null){
		
		if(is_null($path)){

			$path = $this->dir('/app/Models');
		}

		$out = [];

		if(file_exists($path)){

			$results = scandir($path);

			foreach ($results as $result) {

				if ($result === '.' or $result === '..') continue;

				$filename = $path . $this->divider . $result;

				if (is_dir($filename)) {

					$out = array_merge($out, $this->getModels($filename));

				} else{

					$out[] = class_basename(substr($filename,0,-4));
				}
			}

		}

		return array_unique($out);
	}

	/**
	 * @return array
	 */

	public static function getArchives(){

		if(class_exists('\Workhouse\Articles\Providers\ArticlesServiceProvider')){

			return \Workhouse\Articles\Providers\ArticlesServiceProvider::getArchives();
		}

		return [];
	}

	/**
	 *
	 */

	public function loadAssets(){

		$this->publishes([
			$this->dir('/resources/dist/') => public_path()
		], 'assets');
	}

	/**
	 *
	 */

	public function loadRoutes(){

		//ADMIN PANEL

		if(file_exists($routePath = $this->dir('/routes/admin/'))) {

			$adminFiles = Finder::create()->in($routePath)->name( '*.php' );

			//$as ='admin.' . (app('DoctrineInflector')->singularize(Str::lower(Str::afterLast($this->namespace, '\\')))) . '.';

			foreach ( $adminFiles as $file ) {

				Route::middleware( [ 'web', 'auth:administrator' ] )
				     ->namespace( $this->namespace . '\Controllers\Admin' )
				     //->prefix( 'admin' )
				     ->prefix( self::getLocalePrefix('admin') )
				     ->as( 'admin.' )
				     ->group( $file->getRealPath() );
			}
		}


		//WEBSITE
		if(file_exists($viewPath = $this->dir('/routes/website/'))) {

			$websiteFiles = Finder::create()->in( $viewPath )->name( '*.php' );

			foreach ( $websiteFiles as $file ) {

				Route::middleware('web')
					->namespace( $this->namespace . '\Controllers\Website' )
				     ->prefix( self::getLocalePrefix() )
				     ->group( $file->getRealPath() );
			}
		}
	}

	/**
	 *
	 */

	public function loadBreadcrumb(){

	}

	/**
	 *
	 */

	public function loadCommands(){

	}

	/**
	 *
	 */

	public function bootObservers(){


		foreach(array_map(function ($model){

			$model = '\\'.$model;

			return new $model;

		},array_filter(array_keys(config('models')), function($model){

			return !in_array($model, $this->protectedModels);

		})) as $model){

			if($model instanceof Model){

				$observerClass = ModelObserver::class;

				foreach ([
					config('general.observer_namespace'),
					$this->namespace . '\\Observers\\',
				] as $namespace ) {

					if (class_exists($observer = Str::finish(Str::finish($namespace, '\\') . class_basename($model), 'Observer'))) {

						$observerClass = $observer;
					}
				}

				$model::observe($observerClass);
			}
		}
	}

	/**
	 *
	 */

	public function bootSettings() {

	}

	/*public function bootSettings(){

		$settings = [];

		$settingsModel = new \Setting;

		if(Schema::hasTable($settingsModel->getTable())){

			$settingsModel->get()->map(function($setting) use (&$settings) {

				$settings[$setting->getKey()] = $setting->getValue();
			});
		}

		config(['settings' => $settings]);
	}*/

	/**
	 * @param null $route
	 *
	 * @return string
	 */

	public static function getLocalePrefix($route = null){

		$isAdminRoute = $route === 'admin';

		$prefix = '{locale?}';

		if($isAdminRoute){

			$prefix .= '/admin';
		}

		return (config('app.translationby') && !$isAdminRoute) || $isAdminRoute ? $prefix : '/';
	}
}