<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(5); 

        return response()->json($products);
    } 

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json($product);
    } 
}
