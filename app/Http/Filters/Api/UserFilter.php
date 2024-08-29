<?php

namespace App\Http\Filters\Api;

class UserFilter extends QueryFilter
{
    // Search by name or email
    public function search($value)
    {
        return $this->builder->whereAny(['name', 'email'], 'like', "%{$value}%");
    }

    // Status filter (single/multiple)
    public function status($value)
    {
        return $this->builder->whereIn('status', explode(',', $value));
    }

    // Date filter (single/range of dates)
    public function dates($value)
    {
        $dates = explode(',', $value);

        if (count($dates) > 1) {
            return $this->builder->whereBetween('created_at', $dates);
        }

        return $this->builder->whereDate('created_at', $value);
    }
}
