<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComercioController;
use App\Http\Controllers\TransaccionController;
use App\Http\Controllers\EventoTransaccionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/taskboard', function () {
    return 'Bienvenido a TaskBoard, tu pasarela de pagos.';
});

Route::get('/acerca-de', function () {
    return 'TaskBoard es una pasarela de pagos que permite a comercios afiliados recibir pagos y dar seguimiento a sus transacciones.';
});

Route::get('/contacto', function () {
    return 'Josthyn Stanley Cruz Vásquez - josthynvasquez32022@gmail.com';
});

/*
|--------------------------------------------------------------------------
| Rutas de comercios
|--------------------------------------------------------------------------
*/

Route::prefix('comercios')->name('comercios.')->group(function () {
    Route::get('/', [ComercioController::class, 'index'])->name('index');
    Route::get('/{comercio}', [ComercioController::class, 'show'])->name('show');
});


/*
|--------------------------------------------------------------------------
| Rutas de transacciones
|--------------------------------------------------------------------------
*/

Route::get('/transacciones', [TransaccionController::class, 'index']);

Route::get('/transaccion/{transaccion}', [TransaccionController::class, 'show']);

/*
|--------------------------------------------------------------------------
| Rutas de eventos de transacción
|--------------------------------------------------------------------------
*/

Route::get('/eventos-transaccion', [EventoTransaccionController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Rutas de apoyo / ejemplos anteriores
|--------------------------------------------------------------------------
*/

Route::get('/estados', function () {
    return [
        'Iniciada',
        'Procesando',
        'Aprobada',
        'Rechazada',
        'Liquidada'
    ];
});

Route::get('/transaccion/demo', function () {
    return [
        'id' => 1,
        'comercio' => 'Café Amanecer',
        'monto' => 25.50,
        'moneda' => 'USD',
        'estado' => 'Aprobada'
    ];
});