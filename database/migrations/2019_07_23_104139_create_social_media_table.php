<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSocialMediaTable
 */

class CreateSocialMediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up() {

		if(!Schema::hasTable('social_media')) {

			Schema::create( 'social_media', function ( Blueprint $table ) {
				$table->increments( 'id');
				$table->string( 'service', 191);
				$table->string( 'url', 191);
				$table->string( 'name', 191)->nullable();
				$table->string( 'icon', 100);
				$table->integer( 'order');
				$table->timestamps();
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */

	public function down() {

		Schema::drop('social_media');
	}
}