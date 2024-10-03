<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::all();
        return view('library', compact('playlists'));
    }
    
    public function create()
    {
        return view('playlistCreate');
    }

    public function rename($id)
    {
        $playlist = Playlist::findOrFail($id);
        return view('playlistRename', compact('playlist'));
    }
    public function changeName(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:20',
        ]);

        $playlist = Playlist::findOrFail($id);
        $playlist->name = $request->name;
        $playlist->save();
        return redirect()->route('library')->with('success', 'Playlist renamed successfully.');
    }

    public function destroy($id)
    {
        $playlist = Playlist::findOrFail($id);
        $playlist->delete();
        return redirect()->route('library')->with('success', 'Playlist deleted successfully.');
    }

    public function show($id)
    {
        $playlist = Playlist::findOrFail($id);
        return view('playlist', compact('playlist'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20',
        ]);

        $userid = Auth::id();
        
        Playlist::create([
            'name' => $request->name,
            'user' => $userid,
        ]);

        return redirect()->route('library')->with('success', 'Playlist created successfully!');
    }
}
