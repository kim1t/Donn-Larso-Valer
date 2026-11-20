<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExhibitionArtwork extends Model
{
    protected $table = 'exhibition_artwork';

    protected $fillable =
    [
    'exhibition_id',
    'artwork_id',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class, 'offer_id');
    }
}
