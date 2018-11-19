<?php

// route resource
Route::get('/', 'PostsController@index')->name('posts.index');
Route::resource('posts', 'PostsController')->except('index');

Route::get('categories/{category}', 'CategoriesController')->name('categories.show');

Route::get('tags/{tag}', 'TagsController')->name('tags.show');

Auth::routes();

// Route::get('posts/create', 'PostsController@create')->name('posts.create');
// Route::get('posts/{post}', 'PostsController@show')->name('posts.show');
// Route::post('posts', 'PostsController@store')->name('posts.store');
// Route::get('posts/{post}/edit', 'PostsController@edit')->name('posts.edit');
// Route::patch('posts/{post}', 'PostsController@update')->name('posts.update');
// Route::delete('posts/{post}', 'PostsController@destroy')->name('posts.destroy');

// GET, POST, PATCH|PUT, DELETE (OPTIONS)
// REST - Model POST

// index    - GET       - /posts - mostra tutti i posts                             - PostsController@index     - posts.index
// show     - GET       - /posts/{post} - mostra singolo post                       - PostsController@show      - posts.show
// create   - GET       - /posts/create - mostra form creazione singolo post        - PostsController@create    - posts.create
// store    - POST      - /posts - salva nuovo post in db                           - PostsControlelr@store     - posts.store
// edit     - GET       - /posts/{post}/edit - mostra form modifica post esistente  - PostsController@edit      - posts.edit
// update   - PATCH     - /posts/{post} - salva aggiornamenti post esistente        - PostsController@update    - posts.update

// destroy  - DELETE    - /posts/{post} - cancella post da db                       - PostsController@destroy   - posts.destroy
