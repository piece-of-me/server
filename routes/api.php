<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

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

Route::prefix('users')->group(function () {
    Route::post('/register', [\App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::post('/login', [\App\Http\Controllers\UserController::class, 'login'])->name('users.login');
});

Route::middleware('auth:sanctum')->prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('events.index');
    Route::get('/user', [EventController::class, 'userIndex'])->name('events.user.index');
    Route::get('/{event}', [EventController::class, 'show'])->name('events.show');

    Route::post('/', [EventController::class, 'store'])->name('events.store');
});
