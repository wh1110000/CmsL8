<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateProductProductCrossSellsTable
 */

class CreateProductProductCrossSellsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up() {

		if(!Schema::hasTable('product_product_cross_sells')) {

			Schema::create( 'product_product_cross_sells', function ( Blueprint $table ) {
				$table->increments( 'id' );
				$table->integer( 'product_id');
				$table->integer( 'product_cross_sell_id');
			} );
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */

	public function down() {

		Schema::drop('product_product_cross_sells');
	}
}