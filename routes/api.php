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

//Check authorization
Route::post('/details','API\UserController@details')->middleware('auth:api');

//User setting route
Route::prefix('setting')->name('candidate.setting.')->middleware('auth:api')->group(function () {
  Route::post('/profile','API\UserSetting@getProfile');
  Route::put('/profile/update','API\UserSetting@changeProfile');

});

// Front main route
Route::prefix('front-candidate')->name('c.front.')->middleware('auth:api')->group(function(){
  Route::post('/search','API\FrontController@search');
});

// Job activity
Route::prefix('candidate-job')->name('c.job.')->middleware('auth:api')->group(function(){
  Route::post('/apply-job','API\JobController@apply')->name('apply');
  Route::post('/add-favorite','API\JobController@favoritingJob')->name('add_fav');
});
