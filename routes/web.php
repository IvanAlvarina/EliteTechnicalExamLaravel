<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AlbumController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/search-artist', [DashboardController::class, 'searchArtist'])->name('searchArtist');
});


Route::middleware('auth')->group(function () {
    
    Route::get('/Artist', [ArtistController::class, 'index'])->name('Artist');
    Route::get('/Add-Artist/{id?}', [ArtistController::class, 'createOrEdit'])->name('CreateArtist');
    Route::post('/Store-Artist', [ArtistController::class, 'store'])->name('Store-artist');
    Route::put('/Update-Artist/{id}', [ArtistController::class, 'update'])->name('UpdateArtist');
    Route::delete('/Delete-Artist/{id}', [ArtistController::class, 'delete'])->name('DeleteArtist');

    Route::get('/Album', [AlbumController::class, 'index'])->name('Album');
    Route::get('/Add-Album/{id?}', [AlbumController::class, 'createOrEdit'])->name('CreateAlbum');
    Route::post('/Store-Album', [AlbumController::class, 'store'])->name('Store-album');
    Route::put('/Update-Album/{id}', [AlbumController::class, 'update'])->name('UpdateAlbum');
    Route::delete('/Delete-Album/{id}', [AlbumController::class, 'delete'])->name('DeleteAlbum');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
