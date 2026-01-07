<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ads extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'link',
        'description',
        'cover_image',
        'status',
    ];

    protected $appends = [
        'cover_image_full',
    ];
    
    // cover_image_full path getter
    public function getCoverImageFullAttribute()
    {
        $disk = 's3';
        return Storage::disk($disk)->url($this->cover_image);
    }
}
