<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->intended('/login');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/home', function (Request $request) {
    $user = User::where("api_token", $request->token)->first();
    Auth::login($user);
    if($user->role == "Administrator") return redirect()->route('admin.dashboard');
    else return redirect()->route('dashboard');
})->name('home');

Route::get('/dashboard', function () {
    if(Auth::user()->role == "Admin"){
        return redirect()->route('admin.dashboard');
    }
})->name('dashboard');

Route::prefix('admin')->group(function () {
    Route::name('admin.')->group(function () {

        Route::get('/dashboard', function () {
            return view('home');
        })->name('dashboard');

        Route::get('/external/api/view/eav', function () {
            return view('externalApis.view');
        })->name('external.api.view.eav')->middleware('ytsMx');

        Route::controller(UserController::class)->group(function () {
            Route::get('/users/view/auv', 'index')->name('users.view.auv');
            Route::get('/users/create/auc', 'create')->name('users.create.auc');
            Route::get('/users/edit/{id}', 'edit')->name('users.edit');
        });
        Route::controller(RoleController::class)->group(function () {
            Route::get('/roles/view/arv', 'index')->name('roles.view.arv');
            Route::get('/roles/create/arc', 'create')->name('roles.create.arc');
            Route::get('/roles/edit/{id}', 'edit')->name('roles.edit');
            Route::get('/roles/create/permissions/{id}/arcp', 'createPermissions')->name('roles.create.permissions.arcp');
        });
        Route::controller(PermissionController::class)->group(function () {
            Route::get('/permissions/view/apv', 'index')->name('permissions.view.apv');
            Route::get('/permissions/create/apc', 'create')->name('permissions.create.apc');
            Route::get('/permissions/edit/{id}', 'edit')->name('permissions.edit');
        });
        Route::controller(ProductController::class)->group(function () {
            Route::get('/products/view/aprv', 'index')->name('products.view.aprv');
            Route::get('/products/create/aprc', 'create')->name('products.create.aprc');
            Route::get('/products/edit/{id}', 'edit')->name('products.edit');
        });
    });
});
