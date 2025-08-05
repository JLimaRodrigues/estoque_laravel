<?php

use App\Http\Controllers\Auth\{LoginController, RegisterController};
use App\Http\Controllers\RequisicaoController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    // return view('welcome');
    return redirect('login');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('cadastro', [RegisterController::class, 'cadastro'])->name('cadastro');
Route::post('registrar', [RegisterController::class, 'register'])->name('registrar');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    // Cliente/Admin
    Route::get('requisicoes', [RequisicaoController::class, 'index'])->name('requisicoes.index');
    Route::get('requisicoes/criar', [RequisicaoController::class, 'criar'])->name('requisicoes.criar');
    Route::post('requisicoes', [RequisicaoController::class, 'store'])->name('requisicoes.store');

    // Funcionario/Gerente/Admin
    Route::get('requisicoes/saida', [RequisicaoController::class, 'saida'])->name('requisicoes.saida');
    Route::post('requisicoes/confirmar-saida/{id}', [RequisicaoController::class, 'confirmarSaida'])->name('requisicoes.confirmarSaida');

    // Gerente/Admin
    Route::get('relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');

    // Admin
    Route::get('admin/usuarios', [AdminController::class, 'index'])->name('admin.usuarios');
});


Route::get('home', 'HomeController@index')->name('home');
