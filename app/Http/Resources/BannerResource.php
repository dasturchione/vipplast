<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => [
                'uz' => $this->title_uz,
                'ru' => $this->title_ru,
                'en' => $this->title_en,
            ],
            'subtitle' => [
                'uz' => $this->subtitle_uz,
                'ru' => $this->subtitle_ru,
                'en' => $this->subtitle_en,
            ],
            'image_url' => asset('storage/' . $this->image),
            'animation' => $this->animation,
            'titleAnimation' => $this->titleAnimation,
            'subtitleAnimation' => $this->subtitleAnimation,
            'position' => $this->position,
            'link' => $this->link,
            'sort' => $this->sort,
            'status' => $this->status,
        ];
    }
}
