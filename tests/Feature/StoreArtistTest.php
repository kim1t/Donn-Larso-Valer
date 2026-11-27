<?php

declare(strict_types=1);

use App\Models\Artist;
use App\Models\User;

test('a user can create an artist profile', function (): void {
    $user = User::factory()->create();

    $response = $this->postJson('/api/artists', [
        'name' => 'Frida',
        'description' => 'Paints self portraits.',
        'avatar' => 'https://example.com/frida.png',
        'user_id' => $user->id,
    ]);

    $response->assertCreated()
        ->assertJsonPath('message', 'Artist created successfully')
        ->assertJsonPath('data.name', 'Frida');

    $artist = Artist::query()->sole();

    expect($artist->user_id)->toBe($user->id)
        ->and($artist->description)->toBe('Paints self portraits.')
        ->and($artist->user->is($user))->toBeTrue();
});

test('an artist can be created without a description or an avatar', function (): void {
    $user = User::factory()->create();

    $this->postJson('/api/artists', [
        'name' => 'Frida',
        'user_id' => $user->id,
    ])->assertCreated();

    $artist = Artist::query()->sole();

    expect($artist->description)->toBeNull()
        ->and($artist->avatar)->toBeNull();
});
