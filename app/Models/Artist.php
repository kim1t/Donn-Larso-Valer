<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;


class Artist extends Model
{
    protected $fillable = [
    'name',
    'description',
    'avatar',
    'user_id',
];

public function user()
{
    return $this->belongsTo(User::class);
}

public function artworks()
{
    return $this->hasMany(Artwork::class);
}

public function participants(): MorphMany
{
    return $this->morphMany(Participant::class, 'participantable');
}
}
