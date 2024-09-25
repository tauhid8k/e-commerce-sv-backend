<?php

namespace App\Http\Controllers\Api\Shop;

use App\Http\Controllers\Controller;
use App\Http\Filters\Api\BrandFilter;
use App\Http\Requests\Api\Brand\StoreBrandRequest;
use App\Http\Resources\Api\Shop\BrandResource;
use App\Models\Brand;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    use ApiResponses;

    /**
     * Display a listing of the resource.
     */
    public function index(BrandFilter $filters)
    {
        return BrandResource::collection(Brand::filter($filters)->latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        Brand::create($request->validated());

        return $this->success('Brand added', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return $this->success('Brand deleted');
    }
}
