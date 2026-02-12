<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// add soft delete
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'sku',
        'price',
        'stock_quantity',
        'image_path',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class); //Because we use foreign key in product table  from category table 
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
