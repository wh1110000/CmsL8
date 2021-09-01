<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateShopOpeningHoursTable
 */

class CreateShopOpeningHoursTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up() {

		if(!Schema::hasTable('shop_opening_hours')) {

			Schema::create( 'shop_opening_hours', function ( Blueprint $table ) {
				$table->increments( 'id' );
				$table->integer( 'shop_id' );
				$table->integer( 'day' );
				$table->date( 'date' )->nullable();
				$table->string( 'label', 191 )->nullable();
				$table->time( 'open_time' );
				$table->time( 'close_time');
			} );
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */

	public function down() {

		Schema::drop('shop_opening_hours');
	}
}