<?php

namespace App\Http\Controllers\Admin;
 
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;  
use App\Models\Category;
use App\Helpers\UploadHelper; 
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

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
        $this->categoryService->store($request);

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
        $this->categoryService->update($request, $category);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    { 
        UploadHelper::deleteOldImage($category->image, 'category'); 

        $category->delete();
        
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully'); 
    }
}
