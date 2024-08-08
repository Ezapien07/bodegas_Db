<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login/login');
});

Route::post('/login', [App\Http\Controllers\LoginController::class,'authenticate']);
Route::get('/logout', [App\Http\Controllers\LoginController::class,'logout']);
Route::get('/login', [App\Http\Controllers\LoginController::class,'login'])->name('login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 Route::group(['middleware' => ['auth']], function () {
    Route::get('/pagina_principal', [App\Http\Controllers\LoginController::class,'home'])->name('home');
    Route::get('/productos', [App\Http\Controllers\ProductosController::class,'ConsultarAll'])->name('ConsultarAll');
    Route::get('/historialProductos',[App\Http\Controllers\HistorialController::class,'getAllHistorial']);
    Route::get('/inventario',[App\Http\Controllers\ProductosController::class,'getProductosInventario']);
    Route::get('/salidas',[App\Http\Controllers\ProductosController::class,'getProductosSaida']);

    Route::group(['prefix' => 'productos/acciones'], function () {
        Route::post('/agregar',[App\Http\Controllers\ProductosController::class, 'newProducto']);
        Route::post('/aumentar', [App\Http\Controllers\ProductosController::class,'Aumentar']);
        Route::post('/modificar', [App\Http\Controllers\ProductosController::class,'Modificar']);
        Route::post('/eliminar', [App\Http\Controllers\ProductosController::class,'Eliminar']);
        Route::post('/activar', [App\Http\Controllers\ProductosController::class,'Activar']);
        Route::post('/salida', [App\Http\Controllers\ProductosController::class,'Salida']);
    });

 });
