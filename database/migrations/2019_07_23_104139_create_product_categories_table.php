<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateProductCategoriesTable
 */

class CreateProductCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up() {

		if(!Schema::hasTable('product_categories')) {

			Schema::create( 'product_categories', function ( Blueprint $table ) {
				$table->increments( 'id' );
				$table->string( 'title', 191 );
				$table->text( 'description' )->nullable();
				$table->text( 'thumbnail' )->nullable();
				$table->string( 'link', 191 );
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

		Schema::drop('product_categories');
	}
}