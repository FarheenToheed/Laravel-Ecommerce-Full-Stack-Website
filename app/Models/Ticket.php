<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
#[Fillable(['email',
        'subject',
        'message',
        'status',
        'user_id',])]

class Ticket extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
