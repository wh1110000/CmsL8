<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSocialMediaTable
 */

class AddPublishedFieldsToPagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up() {

        Schema::table('pages', function (Blueprint $table) {

            $table->dateTime( 'published_at' )->after('type')->nullable();
            $table->integer( 'published_by' )->after('type')->nullable();
            $table->boolean( 'published' )->after('type');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down() {

        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('published');            
            $table->dropColumn('published_by');
            $table->dropColumn('published_at');
        });
    }
}
