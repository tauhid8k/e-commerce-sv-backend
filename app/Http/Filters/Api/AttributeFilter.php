<?php

namespace App\Http\Filters\Api;

class AttributeFilter extends QueryFilter
{
    // Search by name
    public function search($value)
    {
        return $this->builder->where('name', 'like', "%{$value}%");
    }
}
