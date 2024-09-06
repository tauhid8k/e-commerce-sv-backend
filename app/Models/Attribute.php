<?php

namespace App\Models;

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
}
