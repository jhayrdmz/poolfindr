<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1/host', 'as' => 'api.host.'], function () {
    Route::post('auth/login', 'Auth\AuthController@login')->name('auth.login');
    Route::post('auth/register', 'Auth\RegisterController')->name('auth.register');

    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        Route::get('me', 'AuthController@me')->name('auth.me');
        Route::post('logout', 'AuthController@logout')->name('auth.logout');
        // Route::get('request-password-reset/{user}', 'PasswordResetController@requestPasswordReset')
        //     ->name('auth.request-password-reset');
    });
});
