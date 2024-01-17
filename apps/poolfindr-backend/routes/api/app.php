<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'as' => 'app.'], function () {

    Route::group(['prefix' => 'auth', 'namespace' => 'Auth', 'as' => 'auth.'], function () {
        Route::post('login', 'AuthController@login')->name('login');
        Route::post('register', 'RegisterController')->name('register');
        Route::post('forgot-password', 'ForgotPasswordController@forgotPassword')->name('forgot-password');
        Route::post('verify-token', 'PasswordResetController@verifyToken')->name('verify-token');
        Route::post('reset-password', 'PasswordResetController@passwordReset')->name('reset-password');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
            Route::get('me', 'AuthController@me')->name('auth.me');
            Route::post('logout', 'AuthController@logout')->name('auth.logout');
            Route::get('request-password-reset/{user}', 'PasswordResetController@requestPasswordReset')
                ->name('auth.request-password-reset');
        });

        Route::apiResource('properties', 'PropertyController')->only('index', 'show');
    });
});
