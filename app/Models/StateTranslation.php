<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateTranslation extends Model
{
    use HasFactory;
    public $timestamps = false; // Disable timestamps
    protected $fillable = ['state_name', 'locale', 'state_slug'];
}
