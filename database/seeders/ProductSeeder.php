<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributesByName = Attribute::pluck('id', 'name')->toArray();

        $products = [
            [
                'categories' => [1, 2],
                'name' => 'V Neck T-Shirt',
                'skus' => [
                    [
                        'price' => 29,
                        'attributes' => [
                            'Color' => 'Blue',
                            'Size' => 'XL'
                        ],
                    ],
                    [
                        'price' => 49,
                        'attributes' => [
                            'Color' => 'Red',
                            'Size' => 'XL'
                        ],
                    ],
                    [
                        'price' => 49,
                        'attributes' => [
                            'Color' => 'Green',
                            'Size' => 'XL'
                        ],
                    ],
                    [
                        'price' => 59,
                        'attributes' => [
                            'Color' => 'Black',
                            'Size' => 'XXL'
                        ],
                    ],
                ]
            ],
            [
                'categories' => [1, 2],
                'name' => 'Round Neck T-Shirt',
                'skus' => [
                    [
                        'price' => 19,
                        'attributes' => [
                            'Color' => 'White',
                            'Size' => 'XL'
                        ],
                    ],
                    [
                        'price' => 34,
                        'attributes' => [
                            'Color' => 'Red',
                            'Size' => 'XL'
                        ],
                    ],
                    [
                        'price' => 24,
                        'attributes' => [
                            'Color' => 'Green',
                            'Size' => 'XL'
                        ],
                    ],
                    [
                        'price' => 44,
                        'attributes' => [
                            'Color' => 'Black',
                            'Size' => 'XXL'
                        ],
                    ],
                ]
            ],
        ];

        foreach ($products as $product) {
            DB::transaction(function () use ($product, $attributesByName) {
                $createdProduct = Product::create([
                    'name' => $product['name'],
                    'slug' => str($product['name'])->slug()
                ]);

                // Attach multiple categories
                $createdProduct->categories()->attach($product['categories']);

                foreach ($product['skus'] as $sku) {
                    $skuValue = str($product['name']);
                    $skuOptions = [];

                    foreach ($sku['attributes'] as $name => $value) {
                        $skuValue .= ' ' . $value . ' ' . $name;
                        $attributeOption = AttributeOption::where('attribute_id', $attributesByName[$name])->where('value', $value)->value('id');
                        $skuOptions[] = $attributeOption;
                    }

                    $sku = $createdProduct->skus()->create([
                        'value' => str()->slug($skuValue),
                        'price' => $sku['price']
                    ]);

                    $sku->attributeOptions()->attach($skuOptions);
                }
            });
        }
    }
}
