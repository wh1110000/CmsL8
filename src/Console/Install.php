<?php

namespace wh1110000\CmsL8\Console;

use Doctrine\Inflector\InflectorFactory;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;
use wh1110000\CmsL8\Models\Page;

/**
 * Class TraitMakeCommand
 * @package App\Console\Commands
 */

class Install extends Command {

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */

	protected $signature = 'workhouse:install {name}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */

	protected $description = 'Install Custom Post Type';

	/**
	 * @var
	 */

	public $name;

	/**
	 * @var string
	 */

	public $archiveTable;

	/**
	 * @var string
	 */

	public $pivotTable;

	/**
	 * @var string
	 */

	public $categoriesTable;

	/**
	 * @var
	 */

	public $countriesTable;

	/**
	 * @var \Doctrine\Inflector\InflectorFactory
	 */

	public $inflector;

	/**
	 * Install constructor.
	 */

	public function __construct() {

		$this->inflector = InflectorFactory::create()->build();

		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */

	public function handle() {

		$name = $this->argument('name'); // SINGULAR

		$this->prepare($name);

		$this->exportMigrations();

		$this->exportConfig();

		$this->runMigrations();

		$this->runCache();
	}

	/**
	 * @param $name
	 */

	public function prepare($name){

		$this->name = str_replace('-', '_',Str::lower($name));

		$this->archiveTable = str_replace('-', '_', $this->inflector->tableize($this->inflector->pluralize($this->name)));

		$this->pivotTable =  str_replace('-', '_', $this->inflector->tableize($this->name.'_'.$this->name.'_category'));

		$this->categoriesTable =  str_replace('-', '_', $this->inflector->tableize($this->name.'_categories'));

		$this->countriesTable =  str_replace('-', '_', $this->inflector->tableize($this->name.'_country'));
	}

	/**
	 *
	 */

	public function exportMigrations() {

		foreach(['archives' => $this->archiveTable, 'archive_archive_category' =>  $this->pivotTable, 'archive_categories' =>  $this->categoriesTable, 'archive_country' =>  $this->countriesTable] as $orgTable => $newtable){

			$this->getFileContent(base_path('database/migrations/'.date('Y_m_d_His').'_create_'.$newtable.'_table.php'), '/create_'.$orgTable.'_table.stub');
		}
	}

	/**
	 *
	 */

	public function exportConfig() {

		$this->getFileContent(base_path('config/'.$this->archiveTable.'.php'), '/config.stub');
	}

	/**
	 *
	 */

	public function runMigrations() {

		// Run Database migrations

		try {

			Artisan::call('migrate', array('--path' => '/database/migrations'));

			$this->info('Migration generated successfully!');

		} catch (\Exception $e){

			$this->error('Migration has not been generated');
		}

		// Run Database migrations

		try {

			// Add new post type to Page table

			$page = new Page();

			$page->forceFill([
				'title' => specialCharsToSpaces($this->archiveTable),
				'type' => 'archive',
			])->save();

			$this->info('Post type added to database successfully!');

		} catch (\Exception $e){

			$this->error('Post type has not been added to database: '.$e->getMessage());
		}
	}

	/**
	 *
	 */

	public function runCache(){

		//Route Cache

		Artisan::call('route:cache');

		$this->info('Route Cleared successfully!');
	}

	/**
	 * @param $to
	 * @param $from
	 */

	private function getFileContent($to, $from){

		$content = str_replace(
			['{{name}}', '{{archiveTable}}', '{{pivotTable}}', '{{categoriesTable}}', '{{archiveTableController}}', '{{pivotTableController}}', '{{categoriesTableController}}', '{{countriesTable}}', '{{countriesTableController}}'],
			[$this->name, $this->archiveTable, $this->pivotTable, $this->categoriesTable, $this->inflector->classify($this->archiveTable), $this->inflector->classify($this->pivotTable), $this->inflector->classify($this->categoriesTable), $this->countriesTable, $this->inflector->classify($this->countriesTable)],
			file_get_contents(__DIR__.$from )
		);

		file_put_contents($to, $content, FILE_APPEND);
	}
}