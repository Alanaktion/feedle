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

// TODO: find a clean way to support cookies and tokens for API auth
Route::middleware('auth')->group(function () {
    Route::get('feeds', 'Api\FeedController@index');
    Route::get('feeds/search', 'Api\FeedController@search');
    Route::post('feeds/{feed}/read', 'Api\FeedController@readAll');

    Route::get('posts', 'Api\PostController@index');
    Route::post('posts/{post}', 'Api\PostController@update');

    Route::get('subscriptions', 'Api\SubscriptionController@index');
    Route::post('subscriptions', 'Api\SubscriptionController@create');
    Route::get('subscriptions/{subscription}', 'Api\SubscriptionController@show');
    Route::delete('subscriptions/{subscription}', 'Api\SubscriptionController@unsubscribe');
});
