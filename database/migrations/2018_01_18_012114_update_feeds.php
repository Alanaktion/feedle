<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFeeds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feeds', function (Blueprint $table) {
            $table->dateTime('last_check')->nullable()->change();
            $table->renameColumn('uuid', 'guid');
        });
        Schema::table('feed_posts', function (Blueprint $table) {
            $table->string('url')->after('is_read');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feeds', function (Blueprint $table) {
            $table->dateTime('last_check')->change();
            $table->renameColumn('guid', 'uuid');
        });
        Schema::table('feed_posts', function (Blueprint $table) {
            $table->dropColumn('url');
        });
    }
}
