<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class City extends Model implements TranslatableContract
{
    use HasFactory, Translatable;
    public $timestamps = false; // Disable timestamps if not needed
    protected $fillable  = ['state_id']; // Add other fillable attributes if needed
    public $translatedAttributes = ['city_name','locale','city_slug']; // Translatable attributes
    public function state()
    {
        return $this->belongsTo(State::class);
    }

}
