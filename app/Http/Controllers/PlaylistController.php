<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\songPlaylistController;
use App\Models\songplaylist;
use App\Models\Playlist;
use App\Models\Song;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::where('user', Auth::id())->get();
        $sessionPlaylists = session()->get('sessionPlaylists', []);
        $sessionPlaylistsAsObjects = collect($sessionPlaylists)->map(function($playlist, $id) {
            return [
                'id' => $id,
                'name' => $playlist['name'],
                'is_session' => true 
            ];
        });
        $combinedPlaylists = $playlists->toBase()->merge($sessionPlaylistsAsObjects);

        return view('library', ['combinedPlaylists' => $combinedPlaylists]);
    }

    public function SessionToDatabase($id)
    {
        $sessionPlaylists = session()->get('sessionPlaylists', []);

        if (!array_key_exists($id, $sessionPlaylists)) {
            return redirect()->route('library')->with('error', 'Playlist not found in session.');
        }

        $sessionPlaylist = $sessionPlaylists[$id];

        $playlist = Playlist::create([
            'user' => Auth::id(),
            'name' => $sessionPlaylist['name'],
        ]);

        foreach ($sessionPlaylist['songs'] as $songId) {
            $Findplaylist = Playlist::findOrFail($playlist->id);
            $Findsong = Song::findOrFail($songId);

            songplaylist::create([
                'playlist_id' => $Findplaylist->id,
                'song_id' => $Findsong->id,
            ]);
        }

        unset($sessionPlaylists[$id]);
        session()->put('sessionPlaylists', $sessionPlaylists);

        return redirect()->route('playlists.show', ['id' => $playlist->id])
            ->with('success', 'Playlist has been saved to the database successfully!');
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

        $sessionPlaylists = session()->get('sessionPlaylists', []);

        if (array_key_exists($id, $sessionPlaylists)) {
            Playlist::create([
                'name' => $request->name,
                'user' => Auth::id(),
            ]);

            return redirect()->route('library')->with('success', 'Session playlist renamed and saved successfully.');
        } 
        else {
            $playlist = Playlist::findOrFail($id);
            $playlist->name = $request->name;
            $playlist->save();

            return redirect()->route('library')->with('success', 'Playlist renamed successfully.');
        }
    }


    public function destroy($id)
    {
        $playlist = Playlist::findOrFail($id);
        $playlist->delete();
        return redirect()->route('library')->with('success', 'Playlist deleted successfully.');
    }

    public function show($id)
    {
        $sessionPlaylists = session('sessionPlaylists', []);

        if (array_key_exists($id, $sessionPlaylists)) {
            $playlist = (object) [
                'id' => $id,
                'name' => $sessionPlaylists[$id]['name'],
                'is_session' => true
            ];
        } else {
            $playlist = Playlist::findOrFail($id);
            $playlist->is_session = false;
        }

        return view('playlist', compact('playlist'));
    }

    public function SessionChangeName(Request $request, $id)
    {
        $sessionPlaylists = session()->get('sessionPlaylists', []);

        if (!array_key_exists($id, $sessionPlaylists)) {
            return redirect()->route('library')->with('error', 'Playlist not found in session.');
        }

        $request->validate([
            'name' => 'required|string|max:20',
        ]);

        $sessionPlaylists[$id]['name'] = $request->input('name');
        session()->put('sessionPlaylists', $sessionPlaylists);

        return redirect()->route('library')->with('success', 'Playlist name updated successfully!');
    }

    public function sessionRename($id)
    {
        $sessionPlaylists = session()->get('sessionPlaylists', []);

        if (!array_key_exists($id, $sessionPlaylists)) {
            return redirect()->route('library')->with('error', 'Playlist not found in session.');
        }

        $playlist = ['id' => $id, 'name' => $sessionPlaylists[$id]['name']];
        
        return view('playlistRename', compact('playlist'));
    }
    public function showSessionPlaylist($id)
    {
        $sessionPlaylists = session()->get('sessionPlaylists', []);

        if (!array_key_exists($id, $sessionPlaylists)) {
            return redirect()->route('library')->with('error', 'Session playlist not found.');
        }

        $playlist = $sessionPlaylists[$id];

        return view('playlist', ['playlist' => $playlist, 'is_session' => true]);
    }

    public function destroySessionPlaylist($id)
    {
        $sessionPlaylists = session()->get('sessionPlaylists', []);

        if (array_key_exists($id, $sessionPlaylists)) {
            unset($sessionPlaylists[$id]);
            session(['sessionPlaylists' => $sessionPlaylists]);
        }

        return redirect()->route('library')->with('success', 'Session playlist deleted successfully.');
    }   


    public function create()
    {
        $playlistName = 'New Playlist';
        $userId = Auth::id();

        $sessionPlaylists = session()->get('sessionPlaylists', []);
        $uniqueId = uniqid();

        $sessionPlaylists[$uniqueId] = ['id' => $uniqueId, 'name' => $playlistName, 'songs' => []];
        session(['sessionPlaylists' => $sessionPlaylists]);

        return redirect()->route('library')->with('success', 'Playlist created successfully.');
    }

    public function sessionDestroy($id)
    {
        $sessionPlaylists = session()->get('sessionPlaylists', []);

        if (array_key_exists($id, $sessionPlaylists)) {
            unset($sessionPlaylists[$id]);
            session(['sessionPlaylists' => $sessionPlaylists]);
        }

        return redirect()->route('library')->with('success', 'Sessie-playlist verwijderd.');
    }


}
