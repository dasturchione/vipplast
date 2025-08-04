<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'title_ru',
        'title_uz',
        'title_en',
        'subtitle_uz',
        'subtitle_ru',
        'subtitle_en',
        'image',
        'animation',
        'titleAnimation',
        'subtitleAnimation',
        'position',
        'link',
        'sort',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'sort' => 'integer'
    ];

    public static function rules($isUpdate = false)
    {
        return [
            'title_ru' => 'required|string',
            'title_uz' => 'required|string',
            // 'title_en' => 'required|string',
            'subtitle_ru' => 'required|string',
            'subtitle_uz' => 'required|string',
            // 'subtitle_en' => 'required|string',
            'image' => ($isUpdate ? 'nullable' : 'required') . '|image|mimes:jpg,jpeg,png,webp|max:2048',
            'animation' => 'required|string',
            'titleAnimation' => 'required|string',
            'subtitleAnimation' => 'required|string',
            'position' => 'required|string',
        ];
    }
}
