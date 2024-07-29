<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::controller(AdminController::class)->prefix('admin')->group(function () {
        Route::get('', 'index')->name('admin');
        Route::get('create', 'create')->name('admin.create');
        Route::post('store', 'store')->name('admin.store');
        Route::get('show/{id}', 'show')->name('admin.show');
        Route::get('edit/{id}', 'edit')->name('admin.edit');
        Route::put('update/{id}', 'update')->name('admin.update');
        Route::delete('destroy/{id}', 'destroy')->name('admin.destroy');
    });
});