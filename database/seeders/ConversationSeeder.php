<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Conversation;

class ConversationSeeder extends Seeder
{
    public function run(): void
    {
        Conversation::updateOrCreate(
            ['name' => 'Kimberley and Ocean Art Gallery'],
            []
        );
    }
}