<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityTranslation extends Model
{
    use HasFactory;

    public $timestamps = false; // Disable timestamps
    protected $fillable = ['city_name','locale','city_slug']; // Translatable fields
}
