<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YoutubeBlog extends Model
{
    protected $fillable = [
        'title_uz',
        'title_ru',
        'youtube_id',
    ];

}
