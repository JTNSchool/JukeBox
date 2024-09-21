<?php

namespace App\Http\Controllers;

use App\Models\songplaylist;
use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;

class songPlaylistController extends Controller
{

    public function showsongsfromplaylist($id)
    {
        $playlist = Playlist::findOrFail($id);
        $songs = songplaylist::where('playlist', $id)->get();
        foreach ($songs as $id)
        {
            $song = Song::findOrFail($id);   
        }
        return view('playlist', compact(['songs', 'playlist']));
    }

    public function loadplaylists($songid)
    {
        $playlists = Playlist::all();
        $song = Song::findOrFail($songid);
        return view('selectplaylist', compact(['song', 'playlists']));
    }

    public function addsongtoplaylist($playlistid, $songid)
    {
        $playlist = Playlist::findOrFail($playlistid);
        $song = Song::findOrFail($songid);

        songplaylist::create([
            'playlist' => $playlist->id,
            'song' => $song->id,
        ]);

        return redirect()->route('playlists.show', ['id' => $playlist->id])->with('success', 'Playlist created successfully!');

    }
}
