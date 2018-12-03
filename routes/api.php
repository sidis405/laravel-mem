<?php

Route::as('api.')->prefix('api')->group(function () {
    Route::post('auth', 'Api\AuthController@login')->name('auth');

    Route::resource('posts', 'Api\PostsController')->except('create', 'edit');

    Route::get('tags/{tag}', function () {
        dd('s');
    })->name('tags.show');
    Route::get('categories/{category}', 'Api\CategoriesController@show')->name('categories.show');

    Route::middleware('jwt.auth')->group(function () {
        Route::get('me', 'Api\MeController')->name('me');
    });
});
