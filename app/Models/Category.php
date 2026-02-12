<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name']; // can't do unwanted insertion
    // Get all products that belong to this category.Defines a 1:M relationship: One Category → Many Products
    public function product()
    {
        return $this->hasMany(Product::class); //"App\Models\Product" full calss name as a string 

    }
}
