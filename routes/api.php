<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group(['namespace' => 'Api\Customer', 'prefix' => 'customer'], function () {
    Route::post('/register', 'AuthController@register');
    Route::post('/login', 'AuthController@login');
    Route::post('/verify-otp', 'AuthController@verifyOtp');
    Route::middleware('api')->group(function () {
      Route::get('/profile-info', 'ProfileController@profile_info'); 
      Route::post('/update-profile', 'ProfileController@update_profile'); 
      Route::group(['prefix' => 'wallet'], function () {
      Route::get('/wallet-transaction', 'WelletController@index'); 
      Route::post('/razor-pay', 'WelletController@razor_pay'); 
      Route::post('/recharge-success', 'WelletController@success');
      });
      
      Route::group(['prefix' => 'chat-request'], function () {
        Route::post('/send/{id}', 'ChatController@chatRequestAdd');
        Route::get('/list', 'ChatController@chat_request_list');
        Route::get('/cancel/{id}', 'ChatController@chat_request_cancel');
      });
      
    });
    Route::group(['prefix' => 'astrologer'], function () {
      Route::get('/list', 'AstrologerController@list');
      Route::get('/details/{id}', 'AstrologerController@details');
    });
    Route::group(['prefix' => 'today-horoscope'], function () {
        Route::get('/', 'HoroscopeController@today');
        Route::get('/details/{id}', 'HoroscopeController@details_today');
    });
    Route::group(['prefix' => 'yesterday-horoscope'], function () {
        Route::get('/', 'HoroscopeController@yesterday');
        Route::get('/details/{id}', 'HoroscopeController@details_yesterday');
    });
    Route::group(['prefix' => 'tomorrow-horoscope'], function () {
        Route::get('/', 'HoroscopeController@tomorrow');
        Route::get('/details/{id}', 'HoroscopeController@details_tomorrow');
    });
    Route::group(['prefix' => 'weekly-horoscope'], function () {
        Route::get('/', 'HoroscopeController@weekly');
        Route::get('/details/{id}', 'HoroscopeController@details_weekly');
    });
    Route::group(['prefix' => 'monthly-horoscope'], function () {
        Route::get('/', 'HoroscopeController@monthly');
        Route::get('/details/{id}', 'HoroscopeController@details_monthly');
    });
    Route::group(['prefix' => 'yearly-horoscope'], function () {
        Route::get('/', 'HoroscopeController@yearly');
        Route::get('/details/{id}', 'HoroscopeController@details_yearly');
    });
    Route::get('/zodiac-sign', 'HoroscopeController@index');

});