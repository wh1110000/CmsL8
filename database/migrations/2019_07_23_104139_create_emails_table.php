<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateEmailsTable
 */

class CreateEmailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up() {

		if(!Schema::hasTable('emails')) {

			Schema::create( 'emails', function ( Blueprint $table ) {
				$table->increments( 'id');
				$table->string( 'first_name', 191)->nullable();
				$table->string( 'last_name', 191)->nullable();
				$table->string( 'email', 191)->nullable();
				$table->string( 'phone', 191)->nullable();
				$table->string( 'subject', 191)->nullable();
				$table->string( 'enquiry', 191)->nullable();
				$table->longText( 'data')->nullable();
				$table->enum( 'type', ['inbox', 'sent', 'drafts'])->nullable();
				$table->boolean( 'read')->default(0);
				$table->boolean( 'important')->default(0);
				$table->timestamps();
				$table->softDeletes();
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */

	public function down() {

		Schema::drop('emails');
	}
}