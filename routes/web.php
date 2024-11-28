<?php

//use App\Http\Controllers\categoriaController;

use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\clienteController;
use App\Http\Controllers\compraController;
use App\Http\Controllers\encomiendaController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\marcaController;
use App\Http\Controllers\presentacioneController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\proveedorController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\userController;
use App\Http\Controllers\ventaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\vehiculoController;
use App\Http\Controllers\ventaPasajeController;
use App\Http\Controllers\viajeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('secciones.hero');
});
Route::get('/cotización', function () {
    return view('secciones.cotizacion');
});

Route::get('/contactenos', function () {
    return view('secciones.contactenos');
});

Route::get('/nosotros', function () {
    return view('secciones.nosotros');
});

Route::get('/seguimientos', action: [SeguimientoController::class, 'index'])->name('seguimientos');
Route::get('/buscar-pedido', [SeguimientoController::class, 'buscarPedido'])->name('buscar.pedido');// Route::post('/chat', [ChatBotController::class, 'index']);



Route::get('/panel', [homeController::class, 'index'])->name('panel')->middleware('auth');
// Route::get('/', [homeController::class, 'plantilla'])->name('plantilla');
Route::resources([
    //'categorias' => categoriaController::class,
    'presentaciones' => presentacioneController::class,
    'marcas' => marcaController::class,
    'productos' => ProductoController::class,
    'clientes' => clienteController::class,
    'proveedores' => proveedorController::class,
    'compras' => compraController::class,
    'ventas' => ventaController::class,
    'users' => userController::class,
    'roles' => roleController::class,
    'profile' => profileController::class,
    'vehiculos'=>vehiculoController::class,
    'viajes'=> viajeController::class,
    'ventas_pasajes'=> ventaPasajeController::class

]);
Route::get('/clientes/{id}', [ClienteController::class, 'getClientData']);


Route::get('/login',[loginController::class,'index'])->name('login');
Route::post('/login',[loginController::class,'login']);
Route::get('/logout',[logoutController::class,'logout'])->name('logout');

Route::get('/401', function () {
    return view('pages.401');
});
Route::get('/404', function () {
    return view('pages.404');
});
Route::get('/500', function () {
    return view('pages.500');
});
Route::get('/buscar-cliente', [ventaPasajeController::class, 'buscarClientePorDni'])->name('buscar-cliente');
Route::post('/crear-cliente1', [clienteController::class, 'store1'])->name('clientes.store1');
Route::post('/crear-cliente2', [clienteController::class, 'store2'])->name('clientes.store2');

Route::resource('encomiendas', encomiendaController::class);

Route::post('/viajes/{id}/actualizar-estado', [ViajeController::class, 'actualizarEstado'])->name('viajes.actualizarEstado');

// Ruta para generar la boleta de pasaje en PDF
Route::get('ventas_pasajes/{id}/boleta', [VentaPasajeController::class, 'boleta'])->name('ventas_pasajes.boleta');


