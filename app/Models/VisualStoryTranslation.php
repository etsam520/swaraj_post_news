<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisualStoryTranslation extends Model
{
    use HasFactory;

    public $fillable = ['title', 'description', 'slug', 'locale'];

    // Disable timestamps if you don't need them
    public $timestamps = false;
}
