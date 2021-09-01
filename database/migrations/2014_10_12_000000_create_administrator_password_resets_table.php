<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateAdministratorsTable
 */

class CreateAdministratorPasswordResetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

    public function up() {

	    if(!Schema::hasTable('administrator_password_resets')) {

		    Schema::create( 'administrator_password_resets', function ( Blueprint $table ) {
			    $table->string('email')->index();
			    $table->string('token')->index();
			    $table->timestamp('created_at');
		    } );
	    }
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */

    public function down() {

        Schema::dropIfExists('administrator_password_resets');
    }
}