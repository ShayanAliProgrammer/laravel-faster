<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NestedSubCategory extends Model
{
    /** @use HasFactory<\Database\Factories\NestedSubCategoryFactory> */
    use HasFactory;

    protected $primaryKey = "slug";
    public $incrementing = false; // Prevents auto-incrementing
    protected $keyType = 'string'; // Specifies primary key as string

    protected $fillable = [
        'name',
        'slug',
        'image',
        'sub_category_slug'
    ];

    public function sub_category() {
        return $this->belongsTo(SubCategory::class);
    }
}
