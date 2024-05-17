<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\File; 

class UploadHelper
{
    public static function uploadImage($request, $table_name)
    {
        if($request->hasFile('image')) {  
            $file = $request->file('image');
            $image_name = time().".".$file->getClientOriginalName();
            $file->storeAs('public/'. $table_name,  $image_name);
            return $image_name;
        }

        return null;
    }

    public static function deleteOldImage($imageName,  $table_name)
    {
        $imagePath = 'storage/public/'.$table_name.'/'.$imageName;
         
        if(File::exists($imagePath)){
            unlink($imagePath);
        }
    }

   
}