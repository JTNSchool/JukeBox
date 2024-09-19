<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;


class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::all();
        return view('library', compact('songs'));
    }
    
    public function create()
    {
        return view('playlistCreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:40',
        ]);

        Playlist::create([
            'name' => $request->name,
        ]);

        return redirect()->route('library')->with('success', 'Playlist created successfully!');
    }
}
