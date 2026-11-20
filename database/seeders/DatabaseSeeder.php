<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ArtGallerySeeder::class,
            UserSeeder::class,
            ArtistSeeder::class,
            MediaSeeder::class,
            ArtworkSeeder::class,
            ArtworkMediaSeeder::class,
            ExhibitionSeeder::class,
            ExhibitionArtworkSeeder::class,
            ConversationSeeder::class,
            ParticipantSeeder::class,
            MessageSeeder::class,
        ]);
    }
}