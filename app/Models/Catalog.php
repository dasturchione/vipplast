<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Catalog extends Model
{
    protected $fillable = [
        'page_name',
        'image',
        'sort',
    ];


    public static function rules($isUpdate = false)
    {
        return [
            'page_name' => 'required|string',
            'sort' => 'required|string',
            'image' => ($isUpdate ? 'nullable' : 'required') . '|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            if (!empty($model->image) && Storage::disk('public')->exists($model->image)) {
                Storage::disk('public')->delete($model->image);
            }
        });
    }
}
