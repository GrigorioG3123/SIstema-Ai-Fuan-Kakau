<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProdutorController;
use App\Http\Controllers\Admin\TransasaunController;
use App\Http\Controllers\Admin\KafeTipuController;
use App\Http\Controllers\Admin\ArmajenController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Relatóriu
    Route::get('/relatorio/geral', [DashboardController::class, 'relatorioGeral'])->name('relatorio.geral');
    Route::get('/relatorio/anual', [DashboardController::class, 'relatorioAnual'])->name('relatorio.anual');
    Route::get('/relatorio/mensal', [DashboardController::class, 'relatorioMensal'])->name('relatorio.mensal');

    // Produtór
    Route::resource('produtors', ProdutorController::class);

    // Transasaun
    Route::resource('transasauns', TransasaunController::class);
    Route::get('/transasauns/produsaun', [DashboardController::class, 'transasaunsProdusaun'])->name('transasauns.produsaun');
    Route::get('/transasauns/venda', [DashboardController::class, 'transasaunsVenda'])->name('transasauns.venda');

    // Kafé Tipu
    Route::resource('kafe-tipu', KafeTipuController::class);

    // Armajen
    Route::resource('armajen', ArmajenController::class);
});

// Authentication Routes
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
