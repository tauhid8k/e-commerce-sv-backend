<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SelectOptionResource;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class SelectOptionsController extends Controller
{
    // Categories
    public function getCategories()
    {
        $categories = Category::select('id', 'name')->get();

        return SelectOptionResource::collection($categories);
    }

    // Brands
    public function getBrands()
    {
        $brands = Brand::select('id', 'name')->get();

        return SelectOptionResource::collection($brands);
    }

    // Attributes
    public function getAttributes()
    {
        $attributes = Attribute::select('id', 'name')->get();

        return SelectOptionResource::collection($attributes);
    }

    // Attribute options
    public function getAttributeOptions(string $id)
    {
        $attributeOptions = AttributeOption::where('attribute_id', $id)->get();

        $transformedOptions = $attributeOptions->map(function ($option) {
            return [
                'value' => (string)$option->id,
                'label' => $option->value,
            ];
        });

        return response()->json($transformedOptions);
    }
}
