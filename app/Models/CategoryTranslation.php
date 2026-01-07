<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    use HasFactory;

    // Allow mass assignment
    protected $fillable = ['locale', 'category_name', 'category_slug'];

    // Disable timestamps if you don't need them
    public $timestamps = false;
}
