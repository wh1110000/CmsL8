<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateLangsTable
 */

class CreateLangsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up() {

		if(!Schema::hasTable('langs')) {

			Schema::create( 'langs', function ( Blueprint $table ) {
				$table->increments( 'id');
				$table->string( 'model_type', 191);
				$table->string( 'model_post_type', 191);
				$table->integer( 'model_id');
				$table->string( 'field', 191);
				$table->text( 'text');
				$table->string( 'lang', 10);
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

		Schema::drop('langs');
	}
}