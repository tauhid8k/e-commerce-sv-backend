<?php

namespace App\Models;

use App\Http\Filters\Api\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Get options of the attribute
     */
    public function attributeOptions(): HasMany
    {
        return $this->hasMany(AttributeOption::class);
    }

    /**
     * Apply dynamic filtering to the query builder using a QueryFilter class
     */
    public function scopeFilter(Builder $builder, QueryFilter $filters)
    {
        return $filters->apply($builder);
    }
}
