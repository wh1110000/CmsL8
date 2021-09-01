<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateEmailEmailTagTable
 */

class CreateEmailEmailTagTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up() {

		if(!Schema::hasTable('email_email_tag')) {

			Schema::create( 'email_email_tag', function ( Blueprint $table ) {
				$table->increments( 'id');
				$table->integer( 'email_id');
				$table->integer( 'email_tag_id');
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */

	public function down() {

		Schema::drop('email_email_tag');
	}
}