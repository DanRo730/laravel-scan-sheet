<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect()->route('buscar.manual'); // Redirige a la ruta 'buscar.manual'
});

Route::post('/guardar-producto', [ProductController::class, 'guardar'])->name('producto.guardar');
Route::get('/buscar_qr', [ProductoController::class, 'buscarQR'])->name('buscar.qr');
Route::get('/buscar_M', [ProductController::class, 'index'])->name('buscar.manual');
Route::get('/productos/{codigo}/editar', [ProductController::class, 'editar'])->name('productos.editar');
Route::put('/productos/{codigo}', [ProductController::class, 'actualizar'])->name('productos.actualizar');
Route::get('/producto/{codigo}/imagen', [ProductController::class, 'formularioImagen'])->name('producto.imagen');
Route::post('/producto/{codigo}/imagen', [ProductController::class, 'actualizarImagen'])->name('producto.actualizar.imagen');
Route::get('/agregar', [ProductController::class, 'agregar'])->name('productos.agregar');





