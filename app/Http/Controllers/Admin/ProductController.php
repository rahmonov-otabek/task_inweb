<?php

namespace App\Http\Controllers\Admin;

use DOMDocument;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest; 
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Product;

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
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated(); 
 
        $full_description = $validated['full_description'];

        $dom = new DOMDocument();
        $dom->loadHTML($full_description,9);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {
            $data = base64_decode(explode(',',explode(';',$img->getAttribute('src'))[1])[1]); 
            $image_name = "/upload/" . time(). $key.'.png';
            file_put_contents(public_path().$image_name,$data);

            $img->removeAttribute('src');
            $img->setAttribute('src',$image_name);
        }
        $full_description = $dom->saveHTML();

        $validated['full_description'] = $full_description;
        
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
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        $full_description = $validated['full_description'];

        $dom = new DOMDocument();
        $dom->loadHTML($full_description,9);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) { 
            if (strpos($img->getAttribute('src'),'data:image/') ===0) {
                $data = base64_decode(explode(',',explode(';',$img->getAttribute('src'))[1])[1]); 
                $image_name = "/upload/" . time(). $key.'.png';
                file_put_contents(public_path().$image_name,$data);

                $img->removeAttribute('src');
                $img->setAttribute('src',$image_name);
            }
        }
        $full_description = $dom->saveHTML();

        $validated['full_description'] = $full_description;

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $dom= new DOMDocument();
        $dom->loadHTML($product->full_description,9);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {
            
            $src = $img->getAttribute('src');
            $path = Str::of($src)->after('/');


            if (File::exists($path)) {
                File::delete($path);
               
            }
        }

        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully'); 
    }
}
