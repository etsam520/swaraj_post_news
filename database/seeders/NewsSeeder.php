<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create a sample category and tags
        $category = Category::first(); // Assume you have categories created
        $tags = Tag::limit(5)->get(); // Fetch some tags

        // Create the news article
        $news = News::create([
            'category_id' => $category->id,
            'tags' => $tags->pluck('id')->toArray(),
            'thumbnail' => 'path/to/thumbnail.jpg',
            'cover_photo' => 'path/to/cover.jpg',
            'image' => 'path/to/main_image.jpg',
            'video_link' => 'https://example.com/video',
            'is_breaking' => true,
            'created_by' => 1,
            'approved_by' => 1,
            'is_draft' => false,
            'publish_at' => now(),
            'approved_at' => now(),
        ]);

        // Add translations
        $news->translations()->createMany([
            [
                'locale' => 'en',
                'headline' => 'Breaking News Headline',
                'quote' => 'This is a breaking news quote.',
                'details' => 'Full details of the breaking news...',
                'slug' => Str::slug('Breaking News Headline'),
            ],
            [
                'locale' => 'hi',
                'headline' => 'ब्रेकिंग न्यूज़ हेडलाइन',
                'quote' => 'यह एक ब्रेकिंग न्यूज़ उद्धरण है।',
                'details' => 'ब्रेकिंग न्यूज़ के पूरे विवरण...',
                'slug' => Str::slug('ब्रेकिंग न्यूज़ हेडलाइन'),
            ],
        ]);

        // Add news gallery images
        $news->gallery()->createMany([
            ['image_path' => 'path/to/gallery_image1.jpg'],
            ['image_path' => 'path/to/gallery_image2.jpg'],
        ]);
    }
}
