<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Product;

class WishList extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id')->with('categories','genres');
    }
}
