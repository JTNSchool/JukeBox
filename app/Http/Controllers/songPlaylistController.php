<?php

namespace App\Http\Controllers;

use App\Models\songplaylist;
use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class songPlaylistController extends Controller
{

    public function showsongsfromplaylist($id)
    {
        $playlist = Playlist::findOrFail($id);
        $songs = $playlist->songs;

        if ($playlist->user != Auth::id()) { return redirect()->route('library'); }

        return view('playlist', compact('songs', 'playlist'));
    }

    public function destroy($playlistid, $songid)
    {
        $playlist = Playlist::find($playlistid);

        if ($playlist) 
        {
            $playlist->songs()->detach($songid);
            return redirect()->route('playlists.show', $playlist->id);
        } 
        else 
        {
            $sessionPlaylists = session()->get('sessionPlaylists', []);

            if (isset($sessionPlaylists[$playlistid])) 
            {
                $sessionPlaylist = $sessionPlaylists[$playlistid];
                if (($key = array_search($songid, $sessionPlaylist['songs'])) !== false)
                {
                    unset($sessionPlaylist['songs'][$key]);
                    $sessionPlaylist['songs'] = array_values($sessionPlaylist['songs']);
                    $sessionPlaylists[$playlistid] = $sessionPlaylist;
                    session()->put('sessionPlaylists', $sessionPlaylists);
                    return redirect()->route('session.playlists.show', $playlistid);
                }
            } 
            else 
            {
                return redirect()->back()->withErrors(['Playlist not found']);
            }
        }
       
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
    public function addsongtosessionplaylist($playlistid, $songid)
    {
        $sessionPlaylists = session()->get('sessionPlaylists', []);
        dump($sessionPlaylists);
        $playlistIndex = array_search($playlistid, array_column($sessionPlaylists, 'id'));

        if ($playlistIndex === false) {
            return redirect()->route('library')->with('error', 'Playlist not found in session.');
        }

        $song = Song::findOrFail($songid);

        if (!isset($sessionPlaylists[$playlistid]['songs']) || !is_array($sessionPlaylists[$playlistid]['songs'])) {
            $sessionPlaylists[$playlistid]['songs'] = [];
        }
    
        if (!in_array($songid, $sessionPlaylists[$playlistid]['songs'])) {
            $sessionPlaylists[$playlistid]['songs'][] = $songid;
        }
    
        session()->put('sessionPlaylists', $sessionPlaylists);

        return redirect()->route('session.playlists.show', ['id' => $playlistid])->with('success', 'Song added to playlist successfully!');
    }

}
