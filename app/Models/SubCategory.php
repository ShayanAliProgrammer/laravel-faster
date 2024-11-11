<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    /** @use HasFactory<\Database\Factories\SubCategoryFactory> */
    use HasFactory;

    protected $primaryKey = "slug";

    protected $fillable = [
        'name',
        'slug',
        'image',
        'category_slug'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
