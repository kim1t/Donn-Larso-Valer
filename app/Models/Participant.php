<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use  Illuminate\Database\Eloquent\Relations\MorphTo;

class Participant extends Model
{
    protected $fillable = [
    'conversation_id',
    'participantable_id',
    'participantable_type',
    ];
    
    public function participantable(): MorphTo
    {
        return $this->morphTo();
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
}
