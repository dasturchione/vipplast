<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'logo' => $this->logoUrl,
            'phone' => $this->phone,
            'email' => $this->email,
            'working_hours' => $this->working_hours,
            'address' => [
                'uz' => $this->address_uz,
                'ru' => $this->address_ru,
                'en' => $this->address_en,
            ],
            'about' => [
                'uz' => $this->about_uz,
                'ru' => $this->about_ru,
                'en' => $this->about_en,
            ],
            'meta_title' => [
                'uz' => $this->meta_title_uz,
                'ru' => $this->meta_title_ru,
                'en' => $this->meta_title_en,
            ],
            'meta_description' => [
                'uz' => $this->meta_description_uz,
                'ru' => $this->meta_description_ru,
                'en' => $this->meta_description_en,
            ],
            'meta_keywords' => [
                'uz' => $this->meta_keywords_uz,
                'ru' => $this->meta_keywords_ru,
                'en' => $this->meta_keywords_en,
            ],
            'cert_number' => $this->cert_number,
            'meta_tags' => [
                'uz' => $this->meta_tags_uz,
                'ru' => $this->meta_tags_ru,
                'en' => $this->meta_tags_en,
            ],
            'social' => [
                'instagram' => $this->instagram,
                'telegram' => $this->telegram,
                'facebook' => $this->facebook,
                'twitter' => $this->twitter,
                'vk' => $this->vk,
            ],
            'policy_link' => $this->policy_link,
            'map' => [
                'iframe' => $this->map_iframe,
                'link' => $this->map_link,
            ],
            'catalog' => $this->catalog,
        ];
    }
}
