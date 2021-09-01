<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreatePagesTable
 */

class CreatePropertiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){

		if(!Schema::hasTable('properties')) {

			Schema::create( 'properties', function ( Blueprint $table ) {
				$table->increments( 'id' );
				$table->integer( 'model_id' );
				$table->string( 'model_type', 191 );
				$table->string( 'property', 191 );
				$table->text( 'value' )->nullable();
				$table->enum( 'type', ['int','integer','real','float','double','decimal','string','bool','boolean','object','array','json','collection','date','datetime','timestamp','media'] );
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

		Schema::drop('properties');
	}
}