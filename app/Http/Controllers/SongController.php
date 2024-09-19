<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{

    public function index()
    {
        $songs = Song::all();
        return view('explore', compact('songs'));
    }

    public function show($id)
    {
        $song = Song::findOrFail($id);
        return view('explore', compact('songs'));
    }
}
