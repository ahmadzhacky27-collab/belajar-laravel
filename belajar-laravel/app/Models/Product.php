<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'slug', 'price', 'image', 'brief_description', 'description', 'price_art_cartoon', 'price_art_paper', 'price_hvs', 'price_doff', 'price_glossy', 'price_cutting'];

    // many to one
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // hasManyImage
    public function image()
    {
        return $this->hasMany(ProductImage::class);
    }
}
