<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreatePagesTable
 */

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){

		if(!Schema::hasTable('pages')) {

			Schema::create( 'pages', function ( Blueprint $table ) {
				$table->increments( 'id' );
				$table->integer( 'parent_id' );
				$table->string( 'title', 191 )->nullable();
				$table->text( 'content' )->nullable();
				$table->string( 'link' )->nullable();
				$table->enum( 'type', ['internal', 'external', 'global', 'archive']);
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

		Schema::drop('pages');
	}
}