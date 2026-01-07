<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class State extends Model implements TranslatableContract
{
    use HasFactory  , Translatable;
    public $translatedAttributes = ['state_name','locale','state_slug']; // Translatable attributes
    protected $fillable = []; // Add other fillable attributes if needed
    public $timestamps = false;
    public function cities()
    {
        return $this->hasMany(City::class);
    }

}
