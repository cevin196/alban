<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','homeController@index')->name('dashboard');
Route::resource('/nota', 'notaController');
