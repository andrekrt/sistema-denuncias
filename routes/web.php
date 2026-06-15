<?php

use App\Http\Controllers\DenunciaPublicController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DenunciaController as AdminDenunciaController;
use App\Http\Controllers\Admin\DenunciaComentarioController as AdminDenunciaComentarioController;
use App\Http\Controllers\AcompanhamentoController;
use App\Http\Controllers\Admin\AuditoriaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DenunciaAnexoController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return redirect()->route('denuncias.create');
});

// rotas públicas para registro de denúncias
Route::get('/registrar', [DenunciaPublicController::class, 'create'])->name('denuncias.create');
Route::post('/registrar', [DenunciaPublicController::class, 'store'])->middleware('throttle:registro-denuncias')->name('denuncias.store');

// rotas de acompanhamento de denúncias para usuários autenticados
Route::get('/acompanhamento', [AcompanhamentoController::class, 'form'])->name('acompanhamento.form');
Route::post('/acompanhamento', [AcompanhamentoController::class, 'show'])->name('acompanhamento.show');

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified', 'acessa.denuncias'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rotas de acompanhamento de denúncias para usuários autenticados
Route::middleware(['auth', 'acessa.denuncias'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/denuncias', [AdminDenunciaController::class, 'index'])->name('denuncias.index');
    Route::get('/denuncias/{denuncia}',[AdminDenunciaController::class, 'show'])->name('denuncias.show');
    Route::patch('/denuncias/{denuncia}/status', [AdminDenunciaController::class, 'updateStatus'])->name('denuncias.update-status');

    Route::post('/denuncias/{denuncia}/comentarios', [AdminDenunciaComentarioController::class, 'store'])->name('denuncias.comentarios.store');

    Route::get('/anexos/{anexo}/download', [DenunciaAnexoController::class, 'download'])->name('anexos.download');

    // Rotas de usuarios
    Route::middleware('gerencia.usuarios')->group(function () {
        Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/{usuario}/editar', [UserController::class, 'edit'])->name('usuarios.edit');
        Route::put('/usuarios/{usuario}', [UserController::class, 'update'])->name('usuarios.update');

        Route::get('/usuarios/criar', [UserController::class, 'create'])->name('usuarios.create');
        Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');
        Route::get('/auditoria', [AuditoriaController::class, 'index'])->name('auditoria.index');
    });

});

require __DIR__ . '/auth.php';
