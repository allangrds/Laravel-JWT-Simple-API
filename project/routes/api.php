<?php

use Illuminate\Http\Request;

Route::middleware('throttle:25,1')->group(function () {
    Route::prefix('users')->group(function () {
        Route::post('/', 'UserController@store');
    });

    Route::prefix('auth')->group(function () {
        Route::post('/login', 'AuthController@login');
    });
});

// Route::middleware('auth:api')->group(function () { -> alternativa
Route::middleware('jwt.auth')->group(function () {
    Route::middleware('throttle:25,1')->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        Route::prefix('auth')->group(function () {
            Route::get('/refresh', 'AuthController@refresh');
            //Route::middleware('jwt.refresh')->get('/token/refresh', 'AuthController@refresh'); -> alternativa
            Route::post('/logout', 'AuthController@logout');
        });
    });

    Route::middleware('throttle:40,1')->group(function () {
        Route::prefix('tasks')->group(function () {
            Route::get('/', 'TaskController@index')->name('tasks.index');
            Route::post('/', 'TaskController@store')->name('tasks.store');
            Route::get('/{task}', 'TaskController@show')->name('tasks.show');
            Route::patch('/{task}', 'TaskController@update')->name('tasks.update');
            Route::delete('/{task}', 'TaskController@destroy')->name('tasks.destroy');
        });
    });
});
