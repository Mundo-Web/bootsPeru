<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{

    use HasFactory;
    protected $fillable = ['category_id', 'name', 'description', 'slug', 'image', 'destacar', 'visible', 'status'];
    protected $table = 'subcategories';

    public function category()
    {
        return Category::find($this->category_id);
    }
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function products()
    {
        return $this->hasMany(Products::class, 'subcategory_id');
    }
}
