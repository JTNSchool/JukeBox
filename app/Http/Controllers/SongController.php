<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{

    public function index($genre)
    {
        $AllSongs = Song::all();
        if ($genre == "all") { $songs = Song::all(); }
        else {
            $songs = Song::where('genre', $genre)->get();
        }
        
        return view('explore', compact('songs', 'AllSongs'));
    }

    public function show($id)
    {
        $song = Song::findOrFail($id);
        return view('explore', compact('songs'));
    }
}
