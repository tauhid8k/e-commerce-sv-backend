<?php

namespace App\Http\Controllers\Api\Shop;

use App\Http\Controllers\Controller;
use App\Http\Filters\Api\CategoryFilter;
use App\Http\Requests\Api\Category\StoreCategoryRequest;
use App\Http\Resources\Api\Shop\CategoryResource;
use App\Models\Category;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponses;

    /**
     * Display a listing of the resource.
     */
    public function index(CategoryFilter $filters)
    {
        return CategoryResource::collection(Category::with(['parent:name'])->filter($filters)->latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated());

        return $this->success('Category added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new CategoryResource(Category::findOrFail($id));
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
        Category::destroy($id);

        return $this->success('Category deleted');
    }
}
