<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SelectOptionResource;
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
}
