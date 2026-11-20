<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ArtGallery;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $oceanGallery = ArtGallery::where(
            'name',
            'Ocean Art Gallery'
        )->first();

        $creativeGallery = ArtGallery::where(
            'name',
            'Creative Space Gallery'
        )->first();

        User::updateOrCreate(
            ['username' => 'kimberley'],
            [
                'name' => 'Kimberley',
                'email' => 'kimberley@example.com',
                'password' => 'password123',
                'role' => 'artist',
                'date_of_birth' => '2000-05-15',
                'art_gallery_id' => null,
            ]
        );

        User::updateOrCreate(
            ['username' => 'galleryuser'],
            [
                'name' => 'Gallery User',
                'email' => 'gallery@example.com',
                'password' => 'password123',
                'role' => 'gallery',
                'date_of_birth' => '1995-08-20',
                'art_gallery_id' => $oceanGallery?->id,
            ]
        );
    }
}