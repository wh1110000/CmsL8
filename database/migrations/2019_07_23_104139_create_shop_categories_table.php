<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateShopCategoriesTable
 */

class CreateShopCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up() {

		if(!Schema::hasTable('shop_categories')) {

			Schema::create( 'shop_categories', function ( Blueprint $table ) {
				$table->increments( 'id' );
				$table->string( 'title', 191 );
				$table->text( 'excerpt')->nullable();
				$table->longText( 'description')->nullable();
				$table->integer( 'thumbnail');
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

		Schema::drop('shop_categories');
	}
}