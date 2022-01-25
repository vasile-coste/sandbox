<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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

// show login view
Route::get('/login', [LoginController::class, 'loginView'])->name('login');
// make login
Route::post('/login', [LoginController::class, 'apiLogin'])->name('api.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//logged in area
Route::middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'homeView'])->name('home');
    Route::get('/tasks', [AdminController::class, 'homeView'])->name('home');
});
