<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'add_ons'], function () {
    Route::get('fetchAll', [App\Http\Controllers\add_ons\FetchAll::class, 'fetchAll']);
    Route::get('fetchDiscounted', [App\Http\Controllers\add_ons\FetchDiscounted::class, 'fetch']);
});

Route::group(['prefix' => 'blog'], function () {
    Route::get('fetchAll', [App\Http\Controllers\blog\FetchAll::class, 'fetchAll']);
    Route::get('create', [App\Http\Controllers\blog\Create::class, 'create']);
    Route::get('delete', [App\Http\Controllers\blog\Delete::class, 'delete']);
    Route::get('update', [App\Http\Controllers\blog\Update::class, 'update']);
});

Route::group(['prefix' => 'booking'], function () {
    Route::get('profile', [App\Http\Controllers\booking\Profile::class, 'profile']);
    Route::get('initBooking', [App\Http\Controllers\booking\Book::class, 'init']);
    Route::get('themeAndPacks', [App\Http\Controllers\booking\Book::class, 'themeAndPacks']);
    Route::get('placeReservation', [App\Http\Controllers\booking\Book::class, 'placeReservation']);
    Route::get('fetchAll', [App\Http\Controllers\booking\FetchAll::class, 'fetchAll']);
    Route::get('approve', [App\Http\Controllers\booking\Approve::class, 'approve']);
    Route::get('decline', [App\Http\Controllers\booking\Decline::class, 'decline']);
    Route::get('delete', [App\Http\Controllers\booking\Delete::class, 'delete']);
});

Route::group(['prefix' => 'booking_activity'], function () {
    Route::get('fetchAll', [App\Http\Controllers\booking_activity\FetchAll::class, 'fetchAll']);
    Route::get('add', [App\Http\Controllers\booking_activity\Add::class, 'add']);
    Route::get('delete', [App\Http\Controllers\booking_activity\Delete::class, 'delete']);
    Route::get('update', [App\Http\Controllers\booking_activity\Update::class, 'update']);
});

Route::group(['prefix' => 'booking_addons'], function () {
    Route::get('add', [App\Http\Controllers\booking_addons\Add::class, 'add']);
    Route::get('remove/{dataid}', [App\Http\Controllers\booking_addons\Remove::class, 'remove']);
});

Route::group(['prefix' => 'booking_foods'], function () {
    Route::get('add', [App\Http\Controllers\booking_foods\Add::class, 'add']);
    Route::get('remove/{dataid}', [App\Http\Controllers\booking_foods\Remove::class, 'remove']);
    Route::get('verify', [App\Http\Controllers\booking_foods\Add::class, 'verify']);
});

Route::group(['prefix' => 'categories'], function () {

});

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('counter', [App\Http\Controllers\dashboard\FetchAll::class, 'counter']);
});

Route::group(['prefix' => 'events'], function () {
    Route::get('fetchAll', [App\Http\Controllers\events\FetchAll::class, 'fetchAll']);
    Route::get('checkAvailability', [App\Http\Controllers\events\CheckAvailability::class, 'check']);
    Route::get('add', [App\Http\Controllers\events\Add::class, 'add']);
    Route::get('update', [App\Http\Controllers\events\Update::class, 'update']);
    Route::get('delete', [App\Http\Controllers\events\Delete::class, 'delete']);
});

Route::group(['prefix' => 'inquiry'], function () {
    Route::get('send', [App\Http\Controllers\inquiry\Send::class, 'send']);
});

Route::group(['prefix' => 'inventory_stocks'], function () {

});

Route::group(['prefix' => 'marketing'], function () {
    Route::get('fetchAll', [App\Http\Controllers\marketing\FetchAll::class, 'fetchAll']);
});

Route::group(['prefix' => 'menu'], function () {
    Route::get('fetchAll', [App\Http\Controllers\menu\FetchAll::class, 'fetchAll']);
});

Route::group(['prefix' => 'menu_categories'], function () {

});

Route::group(['prefix' => 'notifications'], function () {

});

Route::group(['prefix' => 'photo'], function () {
    Route::post('upload', [App\Http\Controllers\photo\Upload::class, 'upload']);
    Route::post('uploadFunct', [App\Http\Controllers\photo\UploadFunct::class, 'upload']);
});

Route::group(['prefix' => 'ratings'], function () {

});

Route::group(['prefix' => 'room_images'], function () {

});

Route::group(['prefix' => 'room_type'], function () {

});

Route::group(['prefix' => 'themes'], function () {
    Route::get('fetchAll', [App\Http\Controllers\themes\FetchAll::class, 'fetchAll']);
    Route::get('add', [App\Http\Controllers\themes\Add::class, 'add']);
    Route::get('update', [App\Http\Controllers\themes\Update::class, 'update']);
    Route::get('delete', [App\Http\Controllers\themes\Delete::class, 'delete']);
});

Route::group(['prefix' => 'users_customer'], function () {
    Route::get('login', [App\Http\Controllers\users_customer\Login::class, 'login']);
    Route::get('register', [App\Http\Controllers\users_customer\Register::class, 'register']);
    Route::get('verify', [App\Http\Controllers\users_customer\Verify::class, 'verify']);
    Route::get('sendEmail/{email}/{token}', [App\Http\Controllers\users_customer\Register::class, 'sendEmail']);
});

Route::group(['prefix' => 'users_system'], function () {
    Route::get('login', [App\Http\Controllers\users_system\Login::class, 'login']);
});


