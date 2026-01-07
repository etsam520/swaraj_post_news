<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // Protect the fields from mass assignment
    protected $guarded = [];

    // Define the relationship with the News model
    public function news()
    {
        return $this->belongsTo(News::class);
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
