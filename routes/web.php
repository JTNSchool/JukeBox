<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\SongController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { /* wait until path is  localhost/  */
    return view('welcome'); /* Shows Page Welcom in views/welcome */
});


Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/library', function () {
    return view('library');
})->middleware(['auth', 'verified'])->name('library');


Route::get('/explore', [SongController::class, 'index'])->middleware(['auth', 'verified'])->name('explore');
Route::post('/playlists', [PlaylistController::class, 'store'])->name('playlists.store');
Route::get('/playlists/create', [PlaylistController::class, 'create'])->name('playlists.create');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
