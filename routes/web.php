<?php

Route::get('/', 'TasksController@index');
Route::get('tasks/{task}', 'TasksController@show');

// Route::get('/', function () {
//     $tasks = App\Task::all();
//     return view('welcome', compact('tasks'));

//     // $name = 'Pippo';

//     // $tasks = [
//     //     'Ripassare OOP',
//     //     'Imparare Laravel',
//     //     'Leggere la documentazione'
//     // ];
//     // return $tasks;
//     // return view('welcome', compact('name'));
//     // return view('welcome', ['name' => $name]);
//     // return view('welcome')->withName($name);
//     // return view('welcome')->with('name', $name);
// });

// Route::get('tasks/{id}', function ($id) {
//     return App\Task::find($id);
// });
