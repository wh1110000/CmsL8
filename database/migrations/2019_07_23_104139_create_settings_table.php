<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSettingsTable
 */

class CreateSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up() {

		if(!Schema::hasTable('settings')) {

			Schema::create( 'settings', function ( Blueprint $table ) {
				$table->increments( 'id' );
				$table->string( 'key', 100 );
				$table->text( 'value' );
				$table->timestamps();
			} );
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */

	public function down() {

		Schema::drop('settings');
	}
}