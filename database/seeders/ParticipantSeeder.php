<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Participant;
use App\Models\Conversation;
use App\Models\User;
use App\Models\ArtGallery;

class ParticipantSeeder extends Seeder
{
    public function run(): void
    {
        $conversation = Conversation::where(
            'name',
            'Kimberley and Ocean Art Gallery'
        )->firstOrFail();

        $user = User::where('username', 'kimberley')->firstOrFail();

        $gallery = ArtGallery::where(
            'name',
            'Ocean Art Gallery'
        )->firstOrFail();

        Participant::updateOrCreate(
            [
                'conversation_id' => $conversation->id,
                'participantable_type' => User::class,
                'participantable_id' => $user->id,
            ]
        );

        Participant::updateOrCreate(
            [
                'conversation_id' => $conversation->id,
                'participantable_type' => ArtGallery::class,
                'participantable_id' => $gallery->id,
            ]
        );
    }
}