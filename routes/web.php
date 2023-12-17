<?php

use App\Http\Controllers\Admin\MainController;
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
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin', [MainController::class, 'index'])->name('admin.index');
});

Route::get('/login', \App\Http\Controllers\Auth\LoginController::class)->name('login');
Route::get('/login/{key}', \App\Http\Controllers\Auth\RedirectController::class)->name('auth.redirect');
Route::get('/register', \App\Http\Controllers\Auth\RegisterController::class)->name('register.index');
