<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Technology',
            'Science',
            'Sports',
            'Health',
            'Education',
            'Entertainment',
            'Politics',
            'Travel',
            'Business',
            'Lifestyle',
        ];

        foreach ($tags as $index => $tag) {
            $tagModel = Tag::create([
                'created_by' => 1,
                'updated_by' => null,
                'deleted_by' => null,
            ]);

            $tagModel->translations()->createMany([
                [
                    'locale' => 'en',
                    'tag_name' => $tag,
                    'tag_slug' => Str::slug($tag),
                ],
                [
                    'locale' => 'hi',
                    'tag_name' => $this->getHindiTranslation($tag),
                    'tag_slug' => Str::slug($this->getHindiTranslation($tag)),
                ],
            ]);
        }
    }

    /**
     * Get Hindi translations for tag names.
     *
     * @param string $englishName
     * @return string
     */
    private function getHindiTranslation($englishName)
    {
        $translations = [
            'Technology' => 'प्रौद्योगिकी',
            'Science' => 'विज्ञान',
            'Sports' => 'खेल',
            'Health' => 'स्वास्थ्य',
            'Education' => 'शिक्षा',
            'Entertainment' => 'मनोरंजन',
            'Politics' => 'राजनीति',
            'Travel' => 'यात्रा',
            'Business' => 'व्यापार',
            'Lifestyle' => 'जीवन शैली',
        ];

        return $translations[$englishName] ?? $englishName;
    }
}
