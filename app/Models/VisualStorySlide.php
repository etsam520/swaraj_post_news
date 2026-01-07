<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisualStorySlide extends Model
{
    use HasFactory;

    protected $fillable = ['visual_story_id', 'media'];
    public $timestamps = false;

    public function visualStory()
    {
        return $this->belongsTo(VisualStory::class);
    }
}
