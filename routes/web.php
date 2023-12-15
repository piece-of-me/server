<?php

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

Route::get('/admin', [\App\Http\Controllers\Admin\MainController::class, 'index'])->name('admin.index');

Route::get('/login', \App\Http\Controllers\Auth\LoginController::class)->name('login.index');
Route::get('/register', \App\Http\Controllers\Auth\RegisterController::class)->name('register.index');
