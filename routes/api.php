<?php
use App\Http\Controllers\{
    AuthController,
    BookController,
    UserController,
    SearchController,
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['anonymous.api'])->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware(['auth.api'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/{tag}', [BookController::class, 'show']);
    Route::post('/books', [BookController::class, 'store']);
    Route::put('/books/{tag}', [BookController::class, 'update']);
    Route::delete('/books/{tag}', [BookController::class, 'destroy']);

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    Route::get('/search', [SearchController::class, 'search']);
});
