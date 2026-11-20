<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exhibition extends Model
{
    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'capacity',
        'art_gallery_id',
        'theme',
    ];

    public function artGallery()
    {
        return $this->belongsTo(ArtGallery::class, 'art_gallery_id');
    }

    public function artworks()
    {
        return $this->belongsToMany(
            Artwork::class,
            'exhibition_artwork',
            'exhibition_id',
            'artwork_id'
        )->withTimestamps();
    }
}
