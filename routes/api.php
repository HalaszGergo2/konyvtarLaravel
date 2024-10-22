<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register',[RegisteredUserController::class, 'store']);
Route::post('/login',[AuthenticatedSessionController::class, 'store']);

Route::middleware(['auth:sanctum'])
->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
});

// Kijelentkezés útvonal


Route::middleware(['auth:sanctum',Admin::class])
->group(function () {
    Route::get('/admin/users', [UserController::class, 'index']);
});

//összes kérés egy útvonalon
Route::apiResource('/users', UserController::class);
Route::patch('update-password/{id}', [UserController::class, 'updatePassword']);


    




