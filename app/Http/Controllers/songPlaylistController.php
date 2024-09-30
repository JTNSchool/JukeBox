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
        $songs = $playlist->songs;
        return view('playlist', compact('songs', 'playlist'));
    }

    public function destroy($playlistid, $songid)
    {
        $playlist = Playlist::findOrFail($playlistid);
        $playlist->songs()->detach($songid);
        return redirect()->route('playlists.show', ['id' => $playlistid]);
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
            'playlist_id' => $playlist->id,
            'song_id' => $song->id,
        ]);

        return redirect()->route('playlists.show', ['id' => $playlist->id])->with('success', 'Playlist created successfully!');

    }
}
