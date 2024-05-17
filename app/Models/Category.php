<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title', 
        'image',
        'short_description',
        'full_description', 
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
