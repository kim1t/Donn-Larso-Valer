<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ArtGallery;

class ArtGallerySeeder extends Seeder
{
    public function run(): void
    {
        ArtGallery::updateOrCreate(
        ['name' => 'Ocean Art Gallery'],
        [
            'location' => 'Port Louis',
            'logo' => null,
        ]
    );

        ArtGallery::updateOrCreate(
        ['name' => 'Creative Space Gallery'],
        [
            'location' => 'Moka',
            'logo' => null,
        ]
    );
    }
}