<?php

namespace App\Http\Requests\Api\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'description' => ['required', 'string'],
            'brand' => ['nullable', 'integer', 'exists:brands,id'],

            // Categories array
            'categories' => ['required', 'array', 'min:1'],
            'categories.*' => ['integer', 'exists:categories,id'],

            // Variants array
            'variants' => ['nullable', 'array'],

            // Attributes inside each variant
            'variants.*.attributes' => ['nullable', 'array'],
            'variants.*.attributes.*' => ['integer', 'distinct', 'exists:attribute_options,id'],

            // SKU fields inside each variant
            'variants.*.sku.sku' => ['nullable', 'string'],
            'variants.*.sku.barcode' => ['nullable', 'string'],
            'variants.*.sku.quantity' => ['required', 'integer', 'min:1'],
            'variants.*.sku.stock_visibility' => ['required', 'boolean'],
            'variants.*.sku.stock_alert' => ['nullable', 'integer', 'min:0'],
            'variants.*.sku.old_price' => ['nullable', 'numeric', 'min:0'],
            'variants.*.sku.price' => ['required', 'numeric', 'min:0'],
            'variants.*.sku.cost' => ['nullable', 'numeric', 'min:0'],

            // Images validation for each variant
            'variants.*.images' => ['nullable', 'array'],
            'variants.*.images.*' => ['file', 'max:5120'], // Max 5MB file size

            // Main product images
            'images' => ['nullable', 'array'],
            'images.*' => ['file', 'max:5120'], // Max 5MB file size

            // Other boolean fields
            'is_visible' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'is_new' => ['nullable', 'boolean'],

            // Date validation
            'published_at' => ['nullable', 'date'],

            // SEO fields
            'seo_title' => ['nullable', 'string', 'max:60'],
            'seo_description' => ['nullable', 'string', 'max:160'],
        ];
    }
}
