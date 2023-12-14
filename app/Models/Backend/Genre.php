<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Product;

class Genre extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function movies()
    {
        return $this->belongsToMany(Product::class, 'movie_genre_belongs','genres_id', 'product_id' );
    }
    public function series()
    {
        return $this->belongsToMany(Product::class, 'serie_genre_belongs', 'genres_id', 'product_id');
    }
    public function games()
    {
        return $this->belongsToMany(Product::class, 'game_genre_belongs','genres_id', 'product_id' );
    }

}
