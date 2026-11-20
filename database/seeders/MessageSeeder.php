<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\ExhibitionArtwork;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        $conversation = Conversation::where(
            'name',
            'Kimberley and Ocean Art Gallery'
        )->firstOrFail();

        $offer = ExhibitionArtwork::first();

        Message::updateOrCreate(
            [
                'conversation_id' => $conversation->id,
                'message' => 'Hello! I would like to discuss my artwork for the upcoming exhibition.',
            ],
            [
                'offer_id' => $offer?->id,
            ]
        );
    }
}