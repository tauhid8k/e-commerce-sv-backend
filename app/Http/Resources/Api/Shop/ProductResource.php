<?php

namespace App\Http\Resources\Api\Shop;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'brand' => $this->brand?->name,
            'totalCategories' => $this->categories_count,
            'totalVariants' => $this->skus_count,
            'isNew' => $this->is_new,
            'isVisible' => $this->is_visible,
            'seoTitle' => $this->when(
                $request->routeIs('products.show'),
                $this->seo_title
            ),
            'seoDescription' => $this->when(
                $request->routeIs('products.show'),
                $this->seo_description
            ),
            'publishedAt' => $this->published_at?->diffForHumans(),
            'createdAt' => $this->created_at?->diffForHumans(),
            'updatedAt' => $this->updated_at?->diffForHumans()
        ];
    }
}
