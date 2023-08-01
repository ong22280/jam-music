<?php

namespace Database\Seeders;

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Playlist::count() > 0) {
            echo "There are already playlists in the database.\n";
            return;
        }

        Playlist::factory()->count(10)->create();

        // Attach random songs to each playlist
        $playlists = Playlist::all();
        $songs = Song::all();
        $playlists->each(function ($playlist) use ($songs) {
            $playlist->songs()->attach(
                $songs->random(rand(1, 10))->pluck('id')->toArray()
            );
        });
    }
}
