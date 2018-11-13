<?php

namespace App\Http\Controllers\Api;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $category = Category::create($attributes);

        return new CategoryResource($category);
    }

    public function update(Request $request, Category $category)
    {
        $attributes = $this->validate($request, [
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string'
        ]);

        $category->fill($attributes)->save();

        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response('', 204);
    }
}
