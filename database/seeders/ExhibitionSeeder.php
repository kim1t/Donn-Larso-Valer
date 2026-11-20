<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exhibition;
use App\Models\ArtGallery;

class ExhibitionSeeder extends Seeder
{
    public function run(): void
    {
        $gallery = ArtGallery::where(
            'name',
            'Ocean Art Gallery'
        )->firstOrFail();

        Exhibition::updateOrCreate(
            [
                'title' => 'Coastal Inspirations',
                'art_gallery_id' => $gallery->id,
            ],
            [
                'start_date' => '2026-12-01',
                'end_date' => '2026-12-15',
                'capacity' => 50,
                'theme' => 'Coastal Art',
            ]
        );
    }
}