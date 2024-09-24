<?php

namespace App\Http\Resources\Api\Shop;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'name' => $this->name,
            'parentCategoryName' => $this->parent?->name,
            'slug' => $this->slug,
            'description' => $this->when(
                $request->routeIs('categories.show'),
                $this->description
            ),
            'isVisible' => $this->is_visible,
            'seoTitle' => $this->when(
                $request->routeIs('categories.show'),
                $this->seo_title
            ),
            'seoDescription' => $this->when(
                $request->routeIs('categories.show'),
                $this->seo_description
            ),
            'createdAt' => $this->created_at?->diffForHumans(),
            'updatedAt' => $this->updated_at?->diffForHumans()
        ];
    }
}
