<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Filters\Api\ReviewFilter;
use App\Http\Resources\Api\Shop\ReviewResource;
use App\Models\Review;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    use ApiResponses;

    /**
     * Display a listing of the resource.
     */
    public function index(ReviewFilter $filters)
    {
        return ReviewResource::collection(Review::with(['user:id,name', 'product:id,name'])->filter($filters)->latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
