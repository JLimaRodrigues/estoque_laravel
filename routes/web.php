<?php

use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('/cadastro', [RegisterController::class, 'cadastro'])->name('cadastro');
Route::post('/registrar', [RegisterController::class, 'register'])->name('registrar');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
