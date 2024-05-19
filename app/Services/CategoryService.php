<?php

namespace App\Services;
 
use App\Models\Category;
use App\Helpers\UploadHelper;  

class CategoryService 
{
    
    public function store($request)
    {
        $validated = $request->validated(); 
         
        $validated['image'] = !empty($validated['image']) ? UploadHelper::uploadImage($request, 'category') : null; 

        $category = Category::create($validated);

        return $category;
    }  
    
    public function update($request, $category)
    {
        $validated = $request->validated();

        if(!empty($validated['image'])) {  
            UploadHelper::deleteOldImage($category->image, 'category');
            $validated['image'] = UploadHelper::uploadImage($request, 'category');
        }else{
            $validated['image'] = $category->image;
        } 

        $category->update($validated);

        return $category;
    }

}