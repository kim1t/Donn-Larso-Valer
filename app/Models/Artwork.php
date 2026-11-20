<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    protected $fillable = [
        'mixed_media',
        'artist_id',
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function medias()
{
    return $this->belongsToMany(Media::class, 'artwork_media');
}

public function exhibitions()
{
    return $this->belongsToMany(
        Exhibition::class,
        'exhibition_artwork',
        'artwork_id',
        'exhibition_id'
    )->withTimestamps();
}
}
