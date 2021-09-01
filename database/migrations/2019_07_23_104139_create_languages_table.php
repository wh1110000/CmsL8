<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateLanguagesTable
 */

class CreateLanguagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up() {

		if(!Schema::hasTable('languages')) {

			Schema::create( 'languages', function ( Blueprint $table ) {
				$table->increments( 'id');
				$table->string( 'name', 191);
				$table->string( 'code', 2);
				$table->string( 'icon', 10);
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

		Schema::drop('languages');
	}
}