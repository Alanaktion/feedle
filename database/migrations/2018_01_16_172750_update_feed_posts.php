<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFeedPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * This will make a FeedPost a user-specific entry allowing marking as read.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feed_posts', function (Blueprint $table) {
            $table->dropUnique('feed_posts_uuid_unique');
            $table->unsignedBigInteger('user_id')->after('feed_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('is_read')->after('user_id')->default(false);
            $table->unique(['uuid', 'user_id'], 'feed_posts_uuid_user_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feed_posts', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropUnique('feed_posts_uuid_user_unique');
            $table->dropColumn('user_id');
            $table->dropColumn('is_read');
            $table->unique('uuid');
        });
    }
}
