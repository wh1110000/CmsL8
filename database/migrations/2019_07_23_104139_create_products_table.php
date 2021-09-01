<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateProductsTable
 */

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up() {

		if(!Schema::hasTable('products')) {

			Schema::create( 'products', function ( Blueprint $table ) {
				$table->increments( 'id' );
				$table->string( 'sku', 191 );
				$table->string( 'name', 191 );
				$table->text( 'short_description' )->nullable();
				$table->text( 'description' )->nullable();
				$table->integer( 'thumbnail' )->nullable();
				$table->text( 'gallery' )->nullable();
				$table->string( 'link', 191 );
				$table->integer( 'order' );
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

		Schema::drop('products');
	}
}