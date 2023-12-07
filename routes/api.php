<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:api')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('api.login');
    Route::post('/register', [AuthController::class, 'register'])->name('api.register');
// });

Route::middleware('auth.api')->group(function () {

    Route::prefix('admin')->group(function () {
        Route::name('api.admin.')->group(function () {
            Route::get('/users/view', [UserController::class, 'show'])->name('users.view');
            Route::post('/users/create', [UserController::class, 'store'])->name('users.create');
            Route::post('/users/edit/{id}', [UserController::class, 'update'])->name('users.edit');
            Route::post('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
        });
    });

});

