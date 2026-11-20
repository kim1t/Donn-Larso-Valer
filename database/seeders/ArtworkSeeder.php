<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artwork;
use App\Models\Artist;

class ArtworkSeeder extends Seeder
{
    public function run(): void
    {
        $artist = Artist::where('name', 'Kimberley')->firstOrFail();

        Artwork::updateOrCreate(
            [
                'artist_id' => $artist->id,
                'mixed_media' => 'Coastal Silence',
            ],
            []
        );

        Artwork::updateOrCreate(
            [
                'artist_id' => $artist->id,
                'mixed_media' => 'Tidal Lines',
            ],
            []
        );

        Artwork::updateOrCreate(
            [
                'artist_id' => $artist->id,
                'mixed_media' => 'Quiet Shadows',
            ],
            []
        );
    }
}