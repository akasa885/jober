<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Authentication Route
Route::post('candidate/login', 'API\UserController@login');
Route::post('candidate/register', 'API\UserController@register');

//User setting route
Route::prefix('setting')->name('candidate.setting.')->middleware('auth:api')->group(function () {
  Route::post('/profile','API\UserSetting@getProfile');
  Route::put('/profile/update','API\UserSetting@changeProfile');

});
Route::prefix('front-candidate')->name('candidate.front.')->middleware('auth:api')->group(function(){

});
