<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class songplaylist extends Model
{
    // use HasFactory;

    protected $table = 'songplaylist';
    public $timestamps = false;


    protected $fillable = [
        'playlist',
        'song'
    ];
}
