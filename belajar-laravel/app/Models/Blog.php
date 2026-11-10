<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'blog_category_id',
        'name',
        'brief_description',
        'content',
        'author',
        'cover_path',
        'slug',
    ];

    public function blogCategory()
    {
        return $this->belongsTo(CategoryBlog::class);
    }
}
