<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\AuthTestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('test')->group(function () {
    /** rutas privadas */

    //::auth
    Route::post('/auth/register', [AuthTestController::class, 'register']);
    Route::post('/auth/login', [AuthTestController::class, 'login']);
    Route::get('/auth/usuarios/view', [AuthTestController::class, 'usersView']);
    Route::put('/auth/update/{id}', [AuthTestController::class, 'update']);
    Route::delete('/auth/delete/{id}', [AuthTestController::class, 'delete']);
    Route::middleware('auth:sanctum')->post('/auth/logout', [AuthTestController::class, 'logout']);

    //::categorias
    Route::post('/auth/register/category', [AuthTestController::class, 'registerCategory']);
    Route::put('/auth/update/category/{id}', [AuthTestController::class, 'updateCategory']);

    /*rutas pruebas*/
    Route::middleware(['auth:sanctum', 'role:admin'])->get('/auth/admin', function () {
        return response()->json(['message' => 'Acceso permitido solo a administradores']);

        Route::middleware(['auth:sanctum', 'role:cliente'])->get('/auth/cliente', function () {
            return response()->json(['message' => 'Acceso permitido solo a clientes']);
        });
    });
});




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
