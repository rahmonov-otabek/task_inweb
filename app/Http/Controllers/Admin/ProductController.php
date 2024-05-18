<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;  
use App\Models\Product;
use App\Models\Category;
use App\Helpers\UploadHelper;
use App\Helpers\UploadFromHTMLHelper;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(5); 
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated(); 

        $validated['image'] = !empty($validated['image']) ? UploadHelper::uploadImage($request, 'product') : null;
     
        $validated['full_description'] = UploadFromHTMLHelper::storeImages($validated['full_description']);
        
        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        if(!empty($validated['image'])) {  
            UploadHelper::deleteOldImage($product->image, 'product');
            $validated['image'] = UploadHelper::uploadImage($request, 'product');
        }else{
            $validated['image'] = $product->image;
        }

        UploadFromHTMLHelper::deleteImages($product);
        $validated['full_description'] = UploadFromHTMLHelper::storeImages($validated['full_description']);
         
        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    { 
        UploadHelper::deleteOldImage($product->image, 'product');
        UploadFromHTMLHelper::deleteImages($product);

        $product->delete();
        
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully'); 
    }
}
