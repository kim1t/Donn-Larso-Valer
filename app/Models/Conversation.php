<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable =
    [
    'name',
    ];
    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class, 'conversation_id');
    }


}
