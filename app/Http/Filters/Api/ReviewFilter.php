<?php

namespace App\Http\Filters\Api;

class ReviewFilter extends QueryFilter
{
    // Rating filter
    public function rating($value)
    {
        return $this->builder->whereIn('rating', explode(',', $value));
    }
}
