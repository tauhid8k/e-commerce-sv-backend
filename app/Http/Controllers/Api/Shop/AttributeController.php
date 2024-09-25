<?php

namespace App\Http\Controllers\Api\Shop;

use App\Http\Controllers\Controller;
use App\Http\Filters\Api\AttributeFilter;
use App\Http\Requests\Api\Attribute\StoreAttributeRequest;
use App\Http\Resources\Api\Shop\AttributeResource;
use App\Models\Attribute;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributeController extends Controller
{
    use ApiResponses;

    /**
     * Display a listing of the resource.
     */
    public function index(AttributeFilter $filters)
    {
        $attributes = Attribute::withCount('attributeOptions')->filter($filters)->latest()->paginate();

        return AttributeResource::collection($attributes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttributeRequest $request)
    {
        $attribute = $request->validated();

        DB::transaction(function () use ($attribute) {
            $createdAttribute = Attribute::create(['name' => $attribute['name']]);

            if (count($attribute['options']) > 0) {
                foreach ($attribute['options'] as $optionObject) {
                    $createdAttribute->attributeOptions()->create(['value' => $optionObject['value']]);
                }
            }
        });

        return $this->success('Attribute added', 201);
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
        $attribute = Attribute::findOrFail($id);

        if (strtolower($attribute->name) === 'color') {
            return $this->error('Color attribute cannot be deleted', 422);
        }

        $attribute->delete();

        return $this->success('Attribute deleted');
    }
}
