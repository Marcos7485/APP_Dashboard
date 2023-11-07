<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\Main::class, 'index']);
Route::post('/login', [App\Http\Controllers\Main::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Main::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/predio', [App\Http\Controllers\Main::class, 'predio']);
    Route::get('/Inscricao', [App\Http\Controllers\Main::class, 'inscr'])->name('busqueda_inscr');
    Route::get('/terreno/{inscr}', [App\Http\Controllers\BusquedaController::class, 'terreno'])->name('busqueda_tr');
    Route::post('/predio', [App\Http\Controllers\BusquedaController::class, 'predio'])->name('busqueda_pr');
    Route::get('/endereco/{info}', [App\Http\Controllers\BusquedaController::class, 'endereco'])->name('busqueda_apt');
    Route::get('/info/{id}', [App\Http\Controllers\BusquedaController::class, 'info'])->name('busqueda_apt');
});



// Route::get('/adicionar', [App\Http\Controllers\Main::class, 'adicionar']);