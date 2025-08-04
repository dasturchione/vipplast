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
}
