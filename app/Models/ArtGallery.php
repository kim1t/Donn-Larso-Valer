<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ArtGallery extends Model
{
    //The $fillable property tells Laravel which fields can be filled when creating or updating an Artist record through mass assignment.
    protected $fillable = [
        'name',
        'location',
        'logo',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'art_gallery_id');
    }

    public function exhibitions()
    {
        return $this->hasMany(Exhibition::class, 'art_gallery_id');
    }

     public function participants(): MorphMany
    {
        return $this->morphMany(Participant::class, 'participantable');
    }
}
