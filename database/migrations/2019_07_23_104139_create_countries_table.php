<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateCountriesTable
 */

class CreateCountriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up() {

		if(!Schema::hasTable('countries')) {

			Schema::create( 'countries', function ( Blueprint $table ) {
				$table->increments( 'id');
				$table->integer( 'language_id');
				$table->string( 'code', 191);
				$table->string( 'name', 191);
				$table->string( 'label', 191);
				$table->string( 'alpha2_code', 2);
				$table->string( 'alpha3_code', 3);
				$table->string( 'icon', 6);
				$table->integer( 'priority');
				$table->boolean( 'active')->default(0);
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */

	public function down() {

		Schema::drop('countries');
	}
}