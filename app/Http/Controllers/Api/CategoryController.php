<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;  
use App\Models\Category;
use App\Helpers\UploadHelper; 

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(5); 

        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated(); 
         
        $validated['image'] = !empty($validated['image']) ? UploadHelper::uploadImage($request, 'category') : null; 

        $category = Category::create($validated);

        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();

        if(!empty($validated['image'])) {  
            UploadHelper::deleteOldImage($category->image, 'category');
            $validated['image'] = UploadHelper::uploadImage($request, 'category');
        }else{
            $validated['image'] = $category->image;
        } 

        $category->update($validated);

        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        UploadHelper::deleteOldImage($category->image, 'category'); 

        $category->delete();
        
        return response()->json(null, 204);
    }
}
