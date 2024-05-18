<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\File;  
use Illuminate\Support\Str;
use DOMDocument;

class UploadFromHTMLHelper
{ 
    public static function storeImages($full_description)
    { 
        if(isset($full_description)){
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
        }  

        return $full_description;
    } 

    public static function deleteImages($object)
    {
        if(isset($object->full_description)){
            $dom= new DOMDocument(); 
            $dom->loadHTML($object->full_description,9);
            $images = $dom->getElementsByTagName('img');
    
            foreach ($images as $key => $img) {
                
                $src = $img->getAttribute('src');
                $path = Str::of($src)->after('/'); 
    
                if (File::exists($path)) {
                    File::delete($path); 
                }
            }  
        } 
    }

}