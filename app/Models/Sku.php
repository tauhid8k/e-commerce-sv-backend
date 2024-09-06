<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sku extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function price(): Attribute
    {
        return Attribute::make(
            get: static fn($value) => $value / 100,
            set: static fn($value) => $value * 100,
        );
    }

    /**
     * Get product of the sku
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get attribute options of the sku
     */
    public function attributeOptions(): BelongsToMany
    {
        return $this->belongsToMany(AttributeOption::class);
    }
}
