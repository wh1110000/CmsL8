<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSocialMediaTable
 */

class CreatePagePermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up() {

		if(!Schema::hasTable('page_permissions')) {

			Schema::create( 'page_permissions', function ( Blueprint $table ) {
				$table->increments( 'id');
				$table->integer( 'page_id');
				$table->string( 'lang', 191);
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */

	public function down() {

		Schema::drop('page_permissions');
	}
}