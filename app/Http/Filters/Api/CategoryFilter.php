<?php

namespace App\Http\Filters\Api;

class CategoryFilter extends QueryFilter
{
    // Search by name
    public function search($value)
    {
        return $this->builder->where('name', 'like', "%{$value}%");
    }

    // Visibility filter (single/multiple)
    public function visibility($value)
    {
        return $this->builder->whereIn('is_visible', explode(',', $value));
    }
}
