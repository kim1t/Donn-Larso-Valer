<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Media;

class MediaSeeder extends Seeder
{
    public function run(): void
    {
        Media::updateOrCreate(
            ['media_name' => 'Oil Painting'],
            ['media_type' => 'Image']
        );

        Media::updateOrCreate(
            ['media_name' => 'Watercolour'],
            ['media_type' => 'Image']
        );

        Media::updateOrCreate(
            ['media_name' => 'Digital Artwork'],
            ['media_type' => 'Image']
        );
    }
}