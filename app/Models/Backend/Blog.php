<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\PostCategorie;
use App\Models\Backend\PostTags;
use App\Models\Backend\PostComment;
use App\Models\User;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function post_category()
    {
        return $this->belongsto('App\Models\Backend\PostCategorie');
    }

    public function post_tag()
    {
        return $this->belongsto('App\Models\Backend\PostTags');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(PostCategorie::class, 'post_category_belongs', 'blog_id', 'post_categories_id');
    }

    public function tags()
    {
        return $this->belongsToMany(PostTags::class, 'post_tag_belongs', 'blog_id', 'post_tags_id');
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class, 'blog_id');
    }

}
