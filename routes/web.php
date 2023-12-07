<?php

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

Route::prefix('admin')->group(function () {
    Route::name('admin.')->group(function () {

        Route::get('/dashboard', function () {
            return view('home');
        })->name('dashboard');

        Route::controller(UserController::class)->group(function () {
            Route::get('/users/view', 'index')->name('users.view.auv');
            Route::get('/users/create', 'create')->name('users.create.auc');
        });
    });
});
