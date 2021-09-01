<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateShopsTable
 */

class CreateShopsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up() {

		if(!Schema::hasTable('shops')) {

			Schema::create( 'shops', function ( Blueprint $table ) {
				$table->increments( 'id');
				$table->integer( 'shop_category_id' );
				$table->string( 'name', 191 );
				$table->text( 'short_description')->nullable();
				$table->longText( 'description')->nullable();
				$table->integer( 'thumbnail');
				$table->string( 'manager_name', 191 );
				$table->string( 'phone', 191 )->nullable();
				$table->string( 'email', 191 )->nullable();
				$table->string( 'fax', 191 )->nullable();
				$table->string( 'url_protocol', 191 )->nullable();
				$table->string( 'url', 191 )->nullable();
				$table->string( 'street', 191 )->nullable();
				$table->string( 'street_extra', 191 )->nullable();
				$table->string( 'postcode', 191 )->nullable();
				$table->string( 'city', 191 )->nullable();
				$table->string( 'county', 191 )->nullable();
				$table->integer( 'country_id' )->nullable();
				$table->string( 'latitude', 191 )->nullable();
				$table->string( 'longitude', 191 )->nullable();
				$table->boolean('department' )->default(0);
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

		Schema::drop('shops');
	}
}