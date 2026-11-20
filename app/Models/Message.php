<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
    'conversation_id',
    'message',
    'offer_id',
    ];
    
    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'conversation_id');
    }

    public function offer()
    {
        return $this->belongsTo(ExhibitionArtwork::class, 'offer_id');
    }
}
