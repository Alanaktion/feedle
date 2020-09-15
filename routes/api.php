<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\SubscriptionController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('feeds/search', 'Api\FeedController@search')->middleware('can:viewAny,App\Models\Feed');
    Route::post('feeds/{feed}/read', 'Api\FeedController@readAll')->middleware('can:update,App\Models\Feed');

    Route::resource('posts', PostController::class)
        ->only(['index', 'update']);

    Route::resource('subscriptions', SubscriptionController::class)
        ->only(['index', 'store', 'destroy']);
});
