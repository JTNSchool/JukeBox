<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{


    protected $table = 'songs';
    
    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'songplaylist', 'song_id', 'playlist_id');
    }
}
