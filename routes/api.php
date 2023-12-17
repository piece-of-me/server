<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use Symfony\Component\HttpFoundation\Response;

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

Route::prefix('users')->group(function () {
    Route::post('/register', [UserController::class, 'store'])->name('users.store');
    Route::post('/login', [UserController::class, 'login'])->name('users.login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'me'])->name('user.me');

    Route::post('/users/logout', [UserController::class, 'logout'])->name('users.logout');

    Route::prefix('events')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('events.index');
        Route::get('/user', [EventController::class, 'userIndex'])->name('events.user.index');
        Route::get('/{event}', [EventController::class, 'show'])
            ->missing(fn() => response()->json(status: Response::HTTP_NOT_FOUND))
            ->name('events.show');
        Route::post('/', [EventController::class, 'store'])->name('events.store');
        Route::delete('/{event}', [EventController::class, 'destroy'])
            ->missing(fn() => response()->json(status: Response::HTTP_NOT_FOUND))
            ->name('events.destroy');

        Route::get('/{event}/join', [EventController::class, 'join'])
            ->missing(fn() => response()->json(status: Response::HTTP_NOT_FOUND))
            ->name('events.join');
        Route::get('/{event}/refuse', [EventController::class, 'refuse'])
            ->missing(fn() => response()->json(status: Response::HTTP_NOT_FOUND))
            ->name('events.refuse');
    });
});
