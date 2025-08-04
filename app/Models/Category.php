<?php

namespace App\Models;

use App\Models\Product;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasSlug;
    protected $fillable = [
        'name_uz',
        'name_ru',
        'name_en',
        'description_ru',
        'description_uz',
        'slug',
        'image',
        'status',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }


    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public static function getCategoryTree()
    {
        $arr = self::orderBy('sort')->withCount('subcategories')->get();
        // Запускаем рекурсивную постройку дерева и отдаем на выдачу
        return self::buildTree($arr, 0);
    }

    // Сама функция рекурсии
    public static function buildTree($arr, $pid = 0)
    {
        // Находим всех детей раздела
        $found = $arr->filter(function ($item) use ($pid) {
            return $item->parent_id == $pid;
        });

        // Каждому детю запускаем поиск его детей
        foreach ($found as $key => $cat) {
            $sub = self::buildTree($arr, $cat->id);
            $cat->sub = $sub;
        }

        return $found;
    }

    public static function rules($isUpdate = false)
    {
        return [
            'name_ru' => 'required|string',
            'name_uz' => 'required|string',
            'description_ru' => 'required|string',
            'description_uz' => 'required|string',
            'image' => ($isUpdate ? 'nullable' : 'required') . '|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            // 1. Rasmni o‘chirish
            if (!empty($model->image) && Storage::disk('public')->exists($model->image)) {
                Storage::disk('public')->delete($model->image);
            }

            // 2. Subkategoriyalarni o‘chirish
            if ($model->relationLoaded('subcategories')) {
                // Eager load bo‘lsa
                $model->subcategories->each->delete();
            } else {
                // Lazy load
                $model->subcategories()->each(function ($child) {
                    $child->delete();
                });
            }
        });
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name_ru')
            ->saveSlugsTo('slug')
            ->usingLanguage('ru');
    }
}
