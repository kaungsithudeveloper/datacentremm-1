<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Backend\Category;
use App\Models\Backend\Genre;
use App\Models\Backend\Cast;


class Movie extends Model
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
        return $this->belongsToMany(Cast::class, 'movie_cast_belongs', 'product_id', 'casts_id');
    }

}
