<?php

namespace App\Http\Resources\Api\Shop;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeResource extends JsonResource
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
            'totalValues' => $this->attribute_options_count,
            'createdAt' => $this->created_at?->diffForHumans(),
            'updatedAt' => $this->updated_at?->diffForHumans()
        ];
    }
}
