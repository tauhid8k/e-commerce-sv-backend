<?php

namespace App\Http\Resources\Api\Shop;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
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
            'slug' => $this->slug,
            'website' => $this->website,
            'description' => $this->when(
                $request->routeIs('brands.show'),
                $this->description
            ),
            'isVisible' => $this->is_visible,
            'seoTitle' => $this->when(
                $request->routeIs('brands.show'),
                $this->seo_title
            ),
            'seoDescription' => $this->when(
                $request->routeIs('brands.show'),
                $this->seo_description
            ),
            'createdAt' => $this->created_at?->diffForHumans(),
            'updatedAt' => $this->updated_at?->diffForHumans()
        ];
    }
}
