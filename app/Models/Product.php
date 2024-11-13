<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $primaryKey = "slug";
    public $incrementing = false; // Prevents auto-incrementing
    protected $keyType = 'string'; // Specifies primary key as string

    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'price',
        'nested_sub_category_slug',
    ];

    public function nested_sub_category() {
        return $this->belongsTo(NestedSubCategory::class);
    }
}
