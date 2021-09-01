<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateLangsTable
 */

class CreateMediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up() {

		if(!Schema::hasTable('media')) {

			Schema::create( 'media', function ( Blueprint $table ) {
				$table->increments( 'id');
				$table->string( 'filename', 191);
				$table->string( 'alt', 191);
				$table->bigInteger( 'size');
				$table->text( 'mime_type');
				$table->timestamps();
				$table->softDeletes();
			} );
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */

	public function down() {

		Schema::drop('media');
	}
}