<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\PresentacionesController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('template');
});

Route::view('/panel', 'panel.index')->name('panel');

Route::resource('categorias', CategoriaController::class);

Route::resource('marcas', MarcasController::class);

Route::resource('presentaciones', PresentacionesController::class);

Route::resource('productos', ProductoController::class);

Route::resource('clientes', ClienteController::class);



Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/401', function () {
    return view('pages.401');
});

Route::get('/404', function () {
    return view('pages.404');
});

Route::get('/500', function () {
    return view('pages.500');
});