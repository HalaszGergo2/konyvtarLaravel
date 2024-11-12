<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Librarian;
use App\Http\Middleware\Warehouseman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register',[RegisteredUserController::class, 'store']);
Route::post('/login',[AuthenticatedSessionController::class, 'store']);

Route::get('/books-copies', [BookController::class, 'booksFilterByUser']);

Route::middleware(['auth:sanctum'])
->group(function () {
    //profil kezelése
    Route::apiResource('/auth-users', UserController::class)->except(['destroy']);

    //kölcsönzések
    Route::get('/lendings-count', [LendingController::class, "lendingsCount"]);

    //hány könyv
    Route::get('/lendings-count-distinct', [LendingController::class, "lendingsCountDistinct"]);

    //hány példány van nálam?
    Route::get('/active-lendings-count', [LendingController::class, 'activeLendingsCount']);

    //milyen könyvek
    Route::get('/active-lendings-data', [LendingController::class, "activeLendingsData"]);

    Route::get('/lendings-copies', [LendingController::class, 'lendingsFilterByUser']);

    Route::get('/user-lendings', [UserController::class, 'userLendingsFilterByUser']);

    Route::patch('update-password/{id}', [UserController::class, 'updatePassword']);

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
    
});

// Kijelentkezés útvonal

//admin réteg
Route::middleware(['auth:sanctum',Admin::class])
->group(function () {
    //Route::get('/admin/users', [UserController::class, 'index']);
    Route::apiResource('/admin/users', UserController::class);
});

//könyvtáros réteg
Route::middleware(['auth:sanctum',Librarian::class])
->group(function () {
    //utvonalak
});

//raktáros réteg
Route::middleware(['auth:sanctum',Warehouseman::class])
->group(function () {
    //utvonalak
    Route::get('/warehouseman/copies/{title}', [CopyController::class, 'bookCopyCount']);
});



//összes kérés egy útvonalon
