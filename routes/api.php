<?php

use App\Http\Controllers\LendingController;
use App\Http\Controllers\UserController;
use App\Models\Lending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', [UserController::class, 'index']);
Route::post('/user', [UserController::class, 'store']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);

Route::get('/books', function (Request $request) {
    return $request->books();
})->middleware('auth:sanctum');


Route::get('/lendings', [LendingController::class, 'index']);
Route::post('/lending', [LendingController::class, 'store']);
Route::get('/lending/{user_id}/{copy_id}/{start}', [LendingController::class, 'show']);
Route::patch('/lending/{user_id}/{copy_id}/{start}', [LendingController::class, 'update']);
Route::delete('/lending/{user_id}/{copy_id}/{start}', [LendingController::class, 'destroy']);