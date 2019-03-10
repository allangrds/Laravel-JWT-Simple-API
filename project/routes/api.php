<?php

use Illuminate\Http\Request;

Route::prefix('users')->group(function () {
    Route::post('/', 'UserController@store');
});

Route::prefix('auth')->group(function () {
    Route::post('/login', 'AuthController@login');
});

// Route::middleware('auth:api')->group(function () { -> alternativa
Route::middleware('jwt.auth')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::prefix('auth')->group(function () {
        Route::get('/refresh', 'AuthController@refresh');
        //Route::middleware('jwt.refresh')->get('/token/refresh', 'AuthController@refresh'); -> alternativa
        Route::post('/logout', 'AuthController@logout');
    });
});
