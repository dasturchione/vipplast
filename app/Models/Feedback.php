<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable =[
        'username',
        'phone',
        'subject',
        'message',
        'view',
    ];

    protected $casts = [
        'view' => "bool",
    ];
}
