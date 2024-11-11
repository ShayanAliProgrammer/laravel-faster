<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $primaryKey = "slug";
    public $incrementing = false; // Prevents auto-incrementing
    protected $keyType = 'string'; // Specifies primary key as string

    protected $fillable = [
        'name',
        'slug',
        'image'
    ];
}
