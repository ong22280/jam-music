<?php

namespace Database\Seeders;

use App\Models\Playlist;
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

        Playlist::factory()->count(20)->create();
    }
}
