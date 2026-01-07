<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagTranslation extends Model
{
    use HasFactory;

    // Allow mass assignment of all fields
    protected $guarded = [];

    // Disable timestamps if not needed
    public $timestamps = false;
}
