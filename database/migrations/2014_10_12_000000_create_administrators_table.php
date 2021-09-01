<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateAdministratorsTable
 */

class CreateAdministratorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

    public function up() {

	    if(!Schema::hasTable('administrators')) {

		    Schema::create( 'administrators', function ( Blueprint $table ) {
			    $table->increments( 'id' );
			    $table->string( 'first_name' );
			    $table->string( 'last_name' );
			    $table->string( 'email' )->unique();
			    $table->string( 'password' );
			    $table->rememberToken();
			    $table->timestamps();
		    } );
	    }
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */

    public function down() {

        Schema::dropIfExists('administrators');
    }
}