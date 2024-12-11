<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'add_ons'], function () {

});

Route::group(['prefix' => 'blogs'], function () {

});

Route::group(['prefix' => 'booking'], function () {

});

Route::group(['prefix' => 'booking_activity'], function () {

});

Route::group(['prefix' => 'booking_addons'], function () {

});

Route::group(['prefix' => 'booking_foods'], function () {

});

Route::group(['prefix' => 'categories'], function () {

});

Route::group(['prefix' => 'events'], function () {

});

Route::group(['prefix' => 'inquiry'], function () {

});

Route::group(['prefix' => 'inventory_stocks'], function () {

});

Route::group(['prefix' => 'marketing'], function () {

});

Route::group(['prefix' => 'menu'], function () {

});

Route::group(['prefix' => 'menu_categories'], function () {

});

Route::group(['prefix' => 'notifications'], function () {

});

Route::group(['prefix' => 'ratings'], function () {

});

Route::group(['prefix' => 'room_images'], function () {

});

Route::group(['prefix' => 'room_type'], function () {

});

Route::group(['prefix' => 'themes'], function () {

});

Route::group(['prefix' => 'users_customer'], function () {
    Route::get('login', [App\Http\Controllers\users_customer\Login::class, 'login']);
    Route::get('register', [App\Http\Controllers\users_customer\Register::class, 'register']);
    Route::get('verify', [App\Http\Controllers\users_customer\Verify::class, 'verify']);
});

Route::group(['prefix' => 'users_system'], function () {

});


