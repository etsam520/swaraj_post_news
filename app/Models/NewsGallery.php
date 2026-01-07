<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsGallery extends Model
{
    use HasFactory;
    protected $table = "news_gallery";

    protected $guarded = [];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
