<?php

namespace App\Models;

use App\Models\Category;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasSlug;
    protected $fillable = [
        'category_id',
        'name_ru',
        'name_uz',
        'name_en',
        'image',
        'options_ru',
        'options_uz',
        'options_en',
        'keywords_uz',
        'keywords_ru',
        'slug',
        'description_ru',
        'description_uz',
        'description_en',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Get the options for generating the slug
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name_ru')
            ->saveSlugsTo('slug')
            ->usingLanguage('ru');
    }

    public static function rules($isUpdate = false)
    {
        return [
            'name_ru' => 'required|string',
            'name_uz' => 'required|string',
            // 'name_en' => 'required|string',
            'description_ru' => 'required|string',
            'description_uz' => 'required|string',
            // 'description_en' => 'required|string',
            'image' => ($isUpdate ? 'nullable' : 'required') . '|image|mimes:jpg,jpeg,png,webp|max:2048',
            'options_ru' => 'required|string',
            'options_uz' => 'required|string',
            // 'options_en' => 'required|string',
            'keywords_uz' => 'required|string',
            'keywords_ru' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:1,0',
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
