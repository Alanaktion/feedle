<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function () {
    Route::get('feeds/search', 'Api\FeedController@search')->middleware('can:viewAny,App\Models\Feed');
    Route::post('feeds/{feed}/read', 'Api\FeedController@readAll')->middleware('can:update,App\Models\Feed');

    Route::get('posts', 'Api\PostController@index')->middleware('can:viewAny,App\Models\FeedPost');
    Route::post('posts/{post}', 'Api\PostController@update')->middleware('can:update,post');

    Route::get('subscriptions', 'Api\SubscriptionController@index')->middleware('can:viewAny,App\Models\FeedSubscription');
    Route::post('subscriptions', 'Api\SubscriptionController@create')->middleware('can:create,App\Models\FeedSubscription');
    Route::delete('subscriptions/{subscription}', 'Api\SubscriptionController@unsubscribe')->middleware('can:delete,subscription');
});
