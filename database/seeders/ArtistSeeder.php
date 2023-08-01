<?php

namespace Database\Seeders;

use App\Models\Artist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Artist::count() > 0) {
            echo "There are already artists in the database.\n";
            return;
        }

        Artist::factory()->count(20)->create();
    }
}
