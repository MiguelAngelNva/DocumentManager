<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GestorDocumentosController;
use App\Http\Controllers\servicesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'autentificacion'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function(){
    Route::get('/gestorDocumentos', [GestorDocumentosController::class, 'gestorDocumentos'])->name('gestorDocumentos');
    Route::get('/registerDocument', [GestorDocumentosController::class, 'registerDocument'])->name('registerDocument');
    Route::post('/saveDocument', [GestorDocumentosController::class, 'saveDocument'])->name('saveDocument');
    Route::post('/cargarContenidoDocumentos', [servicesController::class, 'cargarContenidoDocumentos'])->name('cargarContenidoDocumentos');
    Route::post('/editDocument', [GestorDocumentosController::class, 'editDocument'])->name('editDocument');
});

