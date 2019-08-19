<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('url', 180)->unique();
            $table->dateTime('last_check');
            $table->timestamps();
        });
        Schema::create('feed_subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('feed_id');
            $table->foreign('feed_id')->references('id')->on('feeds');
            $table->unique(['user_id', 'feed_id']);
            $table->timestamps();
        });
        Schema::create('feed_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->unsignedBigInteger('feed_id');
            $table->foreign('feed_id')->references('id')->on('feeds');
            $table->string('uuid', 180)->unique();
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feeds');
        Schema::dropIfExists('feed_posts');
        Schema::dropIfExists('feed_subscriptions');
    }
}
