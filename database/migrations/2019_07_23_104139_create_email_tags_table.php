<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateEmailTagsTable
 */

class CreateEmailTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up() {

		if(!Schema::hasTable('email_tags')) {

			Schema::create( 'email_tags', function ( Blueprint $table ) {
				$table->increments( 'id');
				$table->string( 'tag', 191);
				$table->text( 'link')->nullable();
				$table->timestamps();
				$table->softDeletes();
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */

	public function down() {

		Schema::drop('email_tags');
	}
}