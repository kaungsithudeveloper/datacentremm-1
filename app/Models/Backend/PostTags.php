<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Blog;

class PostTags extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'post_tag_belongs', 'post_tags_id', 'blog_id');
    }
}
