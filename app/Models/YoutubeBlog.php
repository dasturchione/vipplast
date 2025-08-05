<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YoutubeBlog extends Model
{
    protected $fillable = [
        'title_uz',
        'title_ru',
        'youtube_id',
        'status',
    ];

    protected $casts = [
        'status' => 'bool'
    ];

    public static function rules($isUpdate = false)
    {
        return [
            'title_ru' => 'required|string',
            'title_uz' => 'required|string',
            // 'title_en' => 'required|string',
            'youtube_id' => 'required|string',
            'status' => 'required|int',
        ];
    }
}
