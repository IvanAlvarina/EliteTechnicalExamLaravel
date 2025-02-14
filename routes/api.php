<?php 

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ArtistController;
use App\Http\Controllers\API\AlbumController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Protected API Routes (Require Bearer Token)
Route::middleware('auth:sanctum')->group(function () {
    
    // Artist CRUD
    Route::get('/artists', [ArtistController::class, 'index']);
    Route::post('/artists-store', [ArtistController::class, 'store']);
    Route::get('/artists/{id}', [ArtistController::class, 'show']);
    Route::put('/artists/{id}', [ArtistController::class, 'update']);
    Route::delete('/artists/{id}', [ArtistController::class, 'destroy']);

    // Album CRUD
    Route::get('/albums', [AlbumController::class, 'index']);
    Route::post('/albums', [AlbumController::class, 'store']);
    Route::get('/albums/{id}', [AlbumController::class, 'show']);
    Route::put('/albums/{id}', [AlbumController::class, 'update']);
    Route::delete('/albums/{id}', [AlbumController::class, 'destroy']);

});
