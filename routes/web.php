<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\songPlaylistController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { /* wait until path is  localhost/  */
    return view('welcome'); /* Shows Page Welcom in views/welcome */
});


Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');


Route::get('/explore/{genre}', [SongController::class, 'index'])->middleware(['auth', 'verified'])->name('explore');

Route::get('/select-playlist/{songid}', [songPlaylistController::class, 'loadplaylists'])->middleware(['auth', 'verified'])->name('songplaylist.loadplaylists');
Route::get('/add-to-playlist/{playlistid}/{songid}', [songPlaylistController::class, 'addsongtoplaylist'])->middleware(['auth', 'verified'])->name('songplaylist.addsongtoplaylist');


Route::get('/playlists', [PlaylistController::class, 'index'])->middleware(['auth', 'verified'])->name('library');
Route::post('/playlists/store', [PlaylistController::class, 'store'])->middleware(['auth', 'verified'])->name('playlists.store');
Route::get('/playlists/create', [PlaylistController::class, 'create'])->middleware(['auth', 'verified'])->name('playlists.create');
Route::get('/playlists/{id}', [songPlaylistController::class, 'showsongsfromplaylist'])->middleware(['auth', 'verified'])->name('playlists.show');
Route::delete('/playlists/{id}', [PlaylistController::class, 'destroy'])->middleware(['auth', 'verified'])->name('playlists.delete');

Route::delete('/delete-song/{playlistid}/{songid}', [songPlaylistController::class, 'destroy'])->middleware(['auth', 'verified'])->name('songplaylist.delete');

Route::get('/playlists/rename/{id}', [PlaylistController::class, 'rename'])->middleware(['auth', 'verified'])->name('playlists.rename');
Route::post('/playlists/ChangeName/{id}', [PlaylistController::class, 'changeName'])->middleware(['auth', 'verified'])->name('playlists.changeName');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
