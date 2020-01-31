<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    
    protected $fillable = [
        'recipient_email',
        'sender_id',
        'team_id',
        'token'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function recipient()
    {
        return $this->hasOne(User::class, 'email', 'recipient_email');
    }

    public function sender()
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }


}
