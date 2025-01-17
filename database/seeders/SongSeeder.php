<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('songs')->insert([
            'name' => "Bad Liar",
            'artist' => "Imagine Dragons",
            'duration' => 260,
        ]);

        DB::table('songs')->insert([
            'name' => "I Ain't Worried",
            'artist' => "OneRepublic",
            'duration' => 239,
        ]);

        DB::table('songs')->insert([
            'name' => "A Little Messed Up",
            'artist' => "June",
            'duration' => 168,
        ]);

    }
}
