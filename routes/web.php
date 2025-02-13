<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArtistController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/Artist', [ArtistController::class, 'index'])->name('Artist');
    Route::get('/Add-Artist/{id?}', [ArtistController::class, 'createOrEdit'])->name('CreateArtist');
    Route::post('/Store-Artist', [ArtistController::class, 'store'])->name('Store-artist');
    Route::put('/Update-Artist/{id}', [ArtistController::class, 'update'])->name('UpdateArtist');
    Route::delete('/Delete-Artist/{id}', [ArtistController::class, 'delete'])->name('DeleteArtist');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
