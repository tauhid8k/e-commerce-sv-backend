<?php

namespace App\Models;

use App\Http\Filters\Api\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the children of the category
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Get the parent of the category
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get products of the category
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * Apply dynamic filtering to the query builder using a QueryFilter class
     */
    public function scopeFilter(Builder $builder, QueryFilter $filters)
    {
        return $filters->apply($builder);
    }
}
