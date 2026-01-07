<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class NewsTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['locale', 'headline', 'quote', 'details', 'slug'];

    // Disable timestamps for translations as they are not required
    public $timestamps = false;
}
