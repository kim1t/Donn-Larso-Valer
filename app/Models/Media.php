<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'media_name',
        'media_type',
    ];

    public function artworks()
    {
        return $this->belongsToMany(Artwork::class, 'artwork_media');
    }
}