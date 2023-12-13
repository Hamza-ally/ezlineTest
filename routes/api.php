<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
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

// Route::middleware('auth:sanctum')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('api.login');
    Route::post('/register', [AuthController::class, 'register'])->name('api.register');
    Route::post('/logout', [AuthController::class, 'destroy'])->name('api.logout');
// });

Route::middleware('auth.api')->group(function () {
    Route::post('/logout', [AuthController::class, 'destroy'])->name('api.logout');
    Route::prefix('admin')->group(function () {
        Route::name('api.admin.')->group(function () {
            Route::get('/users/view', [UserController::class, 'show'])->name('users.view');
            Route::post('/users/create', [UserController::class, 'store'])->name('users.create');
            Route::post('/users/edit/{id}', [UserController::class, 'update'])->name('users.edit');
            Route::post('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');

            Route::get('/roles/view', [RoleController::class, 'show'])->name('roles.view');
            Route::post('/roles/create', [RoleController::class, 'store'])->name('roles.create');
            Route::post('/roles/edit/{id}', [RoleController::class, 'update'])->name('roles.edit');
            Route::post('/roles/delete/{id}', [RoleController::class, 'destroy'])->name('roles.delete');
            Route::post('/roles/create/permissions/{id}', [RoleController::class, 'storePermissions'])->name('roles.create.permissions');

            Route::get('/permissions/view', [PermissionController::class, 'show'])->name('permissions.view');
            Route::post('/permissions/create', [PermissionController::class, 'store'])->name('permissions.create');
            Route::post('/permissions/edit/{id}', [PermissionController::class, 'update'])->name('permissions.edit');
            Route::post('/permissions/delete/{id}', [PermissionController::class, 'destroy'])->name('permissions.delete');

            Route::get('/products/view', [ProductController::class, 'show'])->name('products.view');
            Route::post('/products/create', [ProductController::class, 'store'])->name('products.create');
            Route::post('/products/edit/{id}', [ProductController::class, 'update'])->name('products.edit');
            Route::post('/products/delete/{id}', [ProductController::class, 'destroy'])->name('products.delete');


        });
    });

});

