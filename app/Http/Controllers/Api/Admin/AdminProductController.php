<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Filters\Api\ProductFilter;
use App\Http\Requests\Api\Product\StoreProductRequest;
use App\Http\Resources\Api\Shop\ProductResource;
use App\Models\Product;
use App\Models\Sku;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    use ApiResponses;

    /**
     * Display a listing of the resource.
     */
    public function index(ProductFilter $filters)
    {
        return ProductResource::collection(Product::with(['brand:name'])->withCount(['skus', 'categories'])->filter($filters)->latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        DB::transaction(function () use ($data) {
            // Product creation
            $product = new Product();
            $product->name = $data['name'];
            $product->slug = Str::slug($data['name']);
            $product->description = $data['description'] ?? null;
            $product->brand_id = $data['brand'] ?? null;
            $product->is_visible = $data['is_visible'];
            $product->is_featured = $data['is_featured'];
            $product->is_new = $data['is_new'];
            $product->published_at = $data['published_at'] ?? null;
            $product->seo_title = $data['seo_title'] ?? null;
            $product->seo_description = $data['seo_description'] ?? null;
            $product->save();

            // Categories
            $product->categories()->sync($data['categories']);

            // Variants and SKUs
            if (count($data['variants']) > 0) {
                foreach ($data['variants'] as $variantData) {
                    // Add product_id to the SKU data before creating SKU
                    $skuData = $variantData['sku'];
                    $skuData['product_id'] = $product->id;

                    // Create SKU
                    $sku = Sku::create($skuData);

                    // SKU attribute options associations
                    if (count($variantData['attributes']) > 0) {
                        $sku->attributeOptions()->sync($variantData['attributes']);
                    }
                }
            }
        });

        return $this->success('Product added', 201);
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
        //
    }
}
