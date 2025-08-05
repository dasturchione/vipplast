<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;

class Setting extends Model
{
    protected $fillable = [
        'meta_title_uz',
        'meta_title_ru',
        'meta_title_en',
        'meta_description_uz',
        'meta_description_ru',
        'meta_description_en',
        'meta_keywords_uz',
        'meta_keywords_ru',
        'meta_keywords_en',
        'meta_tags_uz',
        'meta_tags_ru',
        'meta_tags_en',
        'logo',
        'phone',
        'email',
        'address_uz',
        'address_ru',
        'address_en',
        'working_hours',
        'instagram',
        'twitter',
        'vk',
        'facebook',
        'telegram',
        'policy_link',
        'about_ru',
        'about_uz',
        'about_en',
        'map_iframe',
        'catalog',
        'map_link',
    ];

    // logo_url accessor to get the full URL of the logo
    protected function logoUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->logo
                ? asset('storage/' . $this->logo)
                : asset('images/default-logo.png');
        });
    }

    public static function rules(): array
    {
        return [
            'meta_title_uz' => 'required|string|max:255',
            'meta_title_ru' => 'required|string|max:255',

            'meta_description_uz' => 'required|string|max:1000',
            'meta_description_ru' => 'required|string|max:1000',

            'meta_keywords_uz' => 'required|string|max:1000',
            'meta_keywords_ru' => 'required|string|max:1000',

            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048', // 2MB

            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'address_uz' => 'required|string|max:1000',
            'address_ru' => 'required|string|max:1000',

            // 'working_hours' => 'required|string|max:255',

            'instagram' => 'nullable|url|max:255',
            // 'twitter'   => 'nullable|url|max:255',
            // 'vk'        => 'nullable|url|max:255',
            'facebook'  => 'nullable|url|max:255',
            'telegram'  => 'nullable|url|max:255',

            'about_uz' => 'nullable|string',
            'about_ru' => 'nullable|string',
            // 'about_en' => 'nullable|string',

            // 'map_iframe' => 'nullable|string',
            // 'catalog' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,zip|max:5120', // 5MB
            'map_link' => 'nullable|url|max:500',
        ];
    }
}
