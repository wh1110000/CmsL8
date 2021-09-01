<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSeoTable
 */

class CreateSeoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up() {

		if(!Schema::hasTable('seo')) {

			Schema::create( 'seo', function ( Blueprint $table ) {
				$table->increments('id');
				$table->integer('model_id');
				$table->string('model_type', 191);
				$table->string('meta_title', 191);
				$table->text('meta_description');
				$table->string('meta_keywords', 191);
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

		Schema::drop('seo');
	}
}