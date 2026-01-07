<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;


class VisualStory extends Model implements TranslatableContract
{
    use HasFactory , Translatable;
    public $translatedAttributes = ['title', 'description','locale'];
    public $fillable = ['cover_image','city_id', 'status','publishe_by','published_at'];
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function slides()
    {
        return $this->hasMany(VisualStorySlide::class, 'visual_story_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getCoverImageAttribute($value)
    {
        return $value ? asset('storage/'.$value) : null;
    }
    public function getSlidesAttribute($value)
    {
        return $value ? asset('storage/'.$value) : null;
    }
    public function getPublishedAtAttribute($value)
    {
        return $value ? $value->format('Y-m-d') : null;
    }
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }
    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }
    public function scopePublishedBy($query, $user)
    {
        return $query->where('publishe_by', $user->id);
    }

    public function scopeIsActive($query, $isActive = true)
    {
        $status = $isActive ? 'published' : 'reject';
        return $query->where('status', $status);
    }


}
