<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateNavPageTable
 */

class CreateNavPageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up() {

		if(!Schema::hasTable('nav_page')) {

			Schema::create( 'nav_page', function ( Blueprint $table ) {
				$table->increments( 'id' );
				$table->integer( 'content_id' )->nullable();
				$table->integer( 'nav_id' )->nullable();
				$table->string( 'title', 191 )->nullable();
				$table->string( 'type', 191 )->nullable();
				$table->integer( 'nav_order' );
			} );
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */

	public function down() {

		Schema::drop('nav_page');
	}
}