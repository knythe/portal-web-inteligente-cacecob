<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\categoriaController;
use App\Http\Controllers\clienteController;
use App\Http\Controllers\portalController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\servicioController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/* creacion de roles de manera rapida*/
//$role = Role::create(['name' => 'administrador']);



/*Route::get('/', function () {
    return view('auth.login');
});*/

/*Route::prefix('v1')->group(function () {
    //rutas publicas 

    //::auth
    Route::post('/auth/register',[AuthController::class,'register']);
    Route::get('/auth/login',[AuthController::class,'login']);

    Route::get('/', [AuthController::class, 'login'])->name('login');
    //Route::post('/login', [loginController::class, 'login']);
});*/


//  Rutas protegidas para admin
Route::middleware(['auth', 'role:admin'])->prefix('v1')->group(function () {
    Route::get('/admin/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::resource('/admin/usuarios', userController::class);
    Route::post('/usuarios/{id}/toggle-estado', [UserController::class, 'toggleEstado'])->name('usuarios.toggle.estado');
    Route::resource('/admin/roles', roleController::class);
    Route::resource('/admin/categorias', categoriaController::class);
    Route::post('/categorias/{id}/toggle-estado', [categoriaController::class, 'toggleEstado'])->name('categorias.toggle.estado');
    Route::resource('/admin/servicios', servicioController::class);
    Route::post('/servicios/{id}/toggle-estado', [servicioController::class, 'toggleEstado'])->name('servicios.toggle.estado');
    Route::patch('/clientes/{cliente}/estado', [clienteController::class, 'cambiarEstado'])->name('clientes.estado');
    Route::resource('/admin/clientes', clienteController::class);
});

// Rutas públicas o para clientes autenticados
Route::middleware(['auth', 'role:cliente'])->prefix('/portal')->group(function () {
    Route::get('/home', [portalController::class, 'index'])->name('portal');
    Route::get('/seminarios', [portalController::class, 'seminarios'])->name('seminarios');
    Route::get('/diplomados', [portalController::class, 'diplomados'])->name('diplomados');
    Route::get('{id}', [portalController::class, 'show'])->name('portal.show');
    Route::post('/interacciones/favorito', [portalController::class, 'intFavorito'])->name('interacciones.favoritos');
    Route::put('/cliente/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
});

// Página pública o login
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

//Route::get('/home/dashboard',[AuthController::class,'home']) -> name('home');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/** Rutas de autentificacion de google */
Route::get('/google/auth/login', [AuthController::class, 'loginToGoogle'])->name('google.login');
Route::get('/google-callback', [AuthController::class, 'callbackGoogle']);
