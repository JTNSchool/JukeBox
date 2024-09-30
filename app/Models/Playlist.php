<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    // use HasFactory;

    protected $table = 'playlists';
    public $timestamps = false;


    protected $fillable = [
        'name',
        'user'
    ];

    public function songs()
    {
        return $this->belongsToMany(Song::class, 'songplaylist', 'playlist_id', 'song_id');
    }
}
