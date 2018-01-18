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
        });
        Schema::table('feed_posts', function (Blueprint $table) {
            $table->renameColumn('uuid', 'guid');
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
        });
        Schema::table('feed_posts', function (Blueprint $table) {
            $table->renameColumn('guid', 'uuid');
            $table->dropColumn('url');
        });
    }
}
