<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];
    // Get all product that belong to tag .Defines a M:N relationship one tag -> many product && one product -> many tag
    public function product()
    {
        return $this->belongsToMany(Product::class); //"App\Models\Product" full calss name as a string 
    }
}
