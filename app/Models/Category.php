<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model implements TranslatableContract
{
    use HasFactory, SoftDeletes, Translatable;

    // Specify which fields are translatable
    public $translatedAttributes = ['category_name', 'category_slug'];

    // Allow mass assignment
    protected $guarded = [];

    // Define the relationship with the News model
    public function news()
    {
        return $this->hasMany(News::class);
    }


}
