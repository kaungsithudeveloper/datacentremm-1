<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Blog;

class PostCategorie extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'post_category_belongs', 'post_categories_id', 'blog_id');
    }

    public function posts()
    {
        return $this->hasMany(Blog::class);
    }


}
