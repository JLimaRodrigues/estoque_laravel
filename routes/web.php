<?php

use App\Http\Controllers\Auth\{LoginController, RegisterController};
use App\Http\Controllers\{
                            RequisicaoController,
                            RelatorioController,
                            AdminController,
                            ProdutoController
                        };
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
    Route::post('requisicoes', [RequisicaoController::class, 'registrarRequisicao'])->name('requisicoes.registrar');

    // Funcionario/Gerente/Admin
    Route::get('requisicoes/saida', [RequisicaoController::class, 'index'])->name('requisicoes.saida');
    Route::get('requisicoes/auditar-saida/{id}', [RequisicaoController::class, 'auditarSaida'])->name('requisicoes.auditarSaida');
    Route::put('requisicoes/confirmar-saida/{id}', [RequisicaoController::class, 'confirmarSaida'])->name('requisicoes.confirmarSaida');

    // Gerente/Admin
    Route::get('produtos', [ProdutoController::class, 'index'])->name('produtos.index');
    Route::get('produtos/novo', [ProdutoController::class, 'novoProduto'])->name('produtos.novo');
    Route::post('produtos/criar', [ProdutoController::class, 'criar'])->name('produtos.criar');
    Route::get('produtos/editar/{id}', [ProdutoController::class, 'editarProduto'])->name('produtos.editar');
    Route::put('produtos/atualizar/{id}', [ProdutoController::class, 'atualizarProduto'])->name('produtos.atualizar');
    Route::get('produtos/confirmar-exclusao/{id}', [ProdutoController::class, 'confirmarExclusao'])->name('produtos.confirmarExclusao');
    Route::delete('produtos/deletar/{id}', [ProdutoController::class, 'deletar'])->name('produtos.deletar');
    Route::get('relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');

    // Admin
    Route::get('admin/usuarios', [AdminController::class, 'index'])->name('admin.usuarios');
});


Route::get('home', 'HomeController@index')->name('home');
