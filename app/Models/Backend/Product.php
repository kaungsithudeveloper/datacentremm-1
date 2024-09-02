<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Frontend\ProductComment;
use App\Models\User;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'movie_category_belongs', 'product_id', 'categories_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movie_genre_belongs', 'product_id', 'genres_id');
    }

    public function casts()
    {
        return $this->belongsToMany(Cast::class, 'cast_belongs', 'product_id', 'casts_id');
    }

    public function series_categories()
    {
        return $this->belongsToMany(Category::class, 'serie_category_belongs', 'product_id', 'categories_id');
    }

    public function series_genres()
    {
        return $this->belongsToMany(Genre::class, 'serie_genre_belongs', 'product_id', 'genres_id');
    }

    public function series_casts()
    {
        return $this->belongsToMany(Cast::class, 'cast_belongs', 'product_id', 'casts_id');
    }

    public function games_genres()
    {
        return $this->belongsToMany(Genre::class, 'game_genre_belongs', 'product_id', 'genres_id');
    }

    public function comments()
    {
        return $this->hasMany(ProductComment::class, 'product_id');
    }
}
