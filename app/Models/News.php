<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class News extends Model implements TranslatableContract
{
    use HasFactory, SoftDeletes, Translatable;

    protected $fillable = [
        'category_id',
        'city_id',
        'status',
        'tags',
        'thumbnail',
        'cover_photo',
        'image',
        'video_link',
        'is_breaking',
        'created_by',
        'approved_by',
        'is_draft',
        'publish_at',
        'approved_at'
    ];


    // Define translatable fields
    public $translatedAttributes = ['headline', 'quote', 'details', 'slug'];

    // Protect the table from mass assignment
    protected $guarded = [];

    // Define the relationship with categories
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // Define the relationship with cities
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // Define the relationship with tags (many-to-many)
    // public function tags()
    // {
    //     return $this->belongsToMany(Tag::class,'news.tag', 'news_id', 'tag_id');
    // }

    // Define the relationship with news gallery (one-to-many)
    public function gallery()
    {
        return $this->hasMany(NewsGallery::class);
    }

    // Accessor for retrieving the tags as an array
    public function getTagsAttribute($value)
    {
        return json_decode($value, true);
    }

    // Mutator for storing tags as a JSON array
    public function setTagsAttribute($value)
    {
        $this->attributes['tags'] = json_encode($value);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Calculate average rating for the news
    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }

    public function creator()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeIsActive($query, $isActive = true)
    {
        $status = $isActive ? 'publish' : 'reject';
        return $query->where('status', $status);
    }
}
