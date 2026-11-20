<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artist;
use App\Models\User;

class ArtistSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('username', 'kimberley')->firstOrFail();

        Artist::updateOrCreate(
            ['user_id' => $user->id],
            [
                'name' => 'Kimberley',
                'description' => 'Contemporary artist exploring mixed media.',
                'avatar' => 'default-avatar.png',
            ]
        );
    }
}