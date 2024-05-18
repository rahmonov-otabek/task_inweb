<?php

namespace App\Http\Controllers\Admin;
 
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;  
use App\Models\Category;
use App\Helpers\UploadHelper;
use App\Helpers\UploadFromHTMLHelper;

class CategoryController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(5); 
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated(); 

        $validated['image'] = !empty($validated['image']) ? UploadHelper::uploadImage($request, 'category') : null;
     
        $validated['full_description'] = !empty($validated['full_description']) ? UploadFromHTMLHelper::storeImages($validated['full_description']) : null;
         
        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
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

        UploadFromHTMLHelper::deleteImages($category);
        $validated['full_description'] = !empty($validated['full_description']) ? UploadFromHTMLHelper::storeImages($validated['full_description']) : null;

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    { 
        UploadHelper::deleteOldImage($category->image, 'category');
        UploadFromHTMLHelper::deleteImages($category);

        $category->delete();
        
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully'); 
    }
}
