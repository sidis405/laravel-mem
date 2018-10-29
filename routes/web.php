<?php

Route::get('/', 'PostsController@index')->name('posts.index');
Route::get('posts/{post}', 'PostsController@show')->name('posts.show');

// GET, POST, PATCH|PUT, DELETE (OPTIONS)
// REST - Model POST

// index    - GET       - /posts - mostra tutti i posts                             - PostsController@index     - posts.index
// show     - GET       - /posts/{post} - mostra singolo post                       - PostsController@show      - posts.show
// create   - GET       - /posts/create - mostra form creazione singolo post        - PostsController@create    - posts.create
// store    - POST      - /posts - salva nuovo post in db                           - PostsControlelr@store     - posts.store
// edit     - GET       - /posts/{post}/edit - mostra form modifica post esistente  - PostsController@edit      - posts.edit
// update   - PATCH     - /posts/{post} - salva aggiornamenti post esistente        - PostsController@update    - posts.update
// destroy  - DELETE    - /posts/{post} - cancella post da db                       - PostsControlelr@destroy   - posts.destroy

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
