<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    /** @use HasFactory<\Database\Factories\SubCategoryFactory> */
    use HasFactory;

    protected $primaryKey = "slug";
    public $incrementing = false; // Prevents auto-incrementing
    protected $keyType = 'string'; // Specifies primary key as string

    protected $fillable = [
        'name',
        'slug',
        'image',
        'category_slug'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function nested_sub_categories() {
        return $this->hasMany(NestedSubCategory::class);
    }
}
