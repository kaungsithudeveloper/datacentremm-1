<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Product;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function movies()
    {
        return $this->belongsToMany(Product::class, 'movie_category_belongs','categories_id', 'product_id');
    }
    public function series()
    {
        return $this->belongsToMany(Product::class, 'serie_category_belongs','categories_id', 'product_id');
    }

}
