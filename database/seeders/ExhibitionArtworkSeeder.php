<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exhibition;
use App\Models\Artwork;

class ExhibitionArtworkSeeder extends Seeder
{
    public function run(): void
    {
        $exhibition = Exhibition::where(
            'title',
            'Coastal Inspirations'
        )->firstOrFail();

        $artworks = Artwork::whereIn('mixed_media', [
            'Coastal Silence',
            'Tidal Lines',
            'Quiet Shadows',
        ])->get();

        foreach ($artworks as $artwork) {
            $exhibition->artworks()->syncWithoutDetaching([
                $artwork->id
            ]);
        }
    }
}