<?php

namespace App\Http\Resources\Api\Shop;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'user' => $this->user->name,
            'product' => $this->product->name,
            'rating' => $this->rating,
            'review' => $this->when(
                $request->routeIs('reviews.show'),
                $this->review
            ),
            'isApproved' => $this->is_approved,
            'createdAt' => $this->created_at?->diffForHumans(),
            'updatedAt' => $this->updated_at?->diffForHumans()
        ];
    }
}
