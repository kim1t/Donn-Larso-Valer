<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artwork;
use App\Models\Media;

class ArtworkMediaSeeder extends Seeder
{
    public function run(): void
    {
        $coastal = Artwork::where('mixed_media', 'Coastal Silence')->firstOrFail();
        $tidal = Artwork::where('mixed_media', 'Tidal Lines')->firstOrFail();
        $shadows = Artwork::where('mixed_media', 'Quiet Shadows')->firstOrFail();

        $oil = Media::where('media_name', 'Oil Painting')->firstOrFail();
        $watercolour = Media::where('media_name', 'Watercolour')->firstOrFail();
        $digital = Media::where('media_name', 'Digital Artwork')->firstOrFail();

        $coastal->medias()->syncWithoutDetaching([$oil->id]);
        $tidal->medias()->syncWithoutDetaching([$watercolour->id]);
        $shadows->medias()->syncWithoutDetaching([$digital->id]);
    }
}