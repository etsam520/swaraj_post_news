<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str ;

class CategorySeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Example category names in English
        $categories = [
            'Technology',
            'Science',
            'Sports',
            'Health',
            'Education',
            'Entertainment',
            'Politics',
            'Travel',
            'Business',
            'Lifestyle'
        ];

        // Loop to create categories and their translations
        foreach ($categories as $index => $category) {
            // Create the main category
            $categoryModel = Category::create([
                'category_photo' => 'category_photo_' . ($index + 1) . '.jpg',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => null,
                'deleted_by' => null,
            ]);

            // Add translations for English and Hindi
            $categoryModel->translations()->createMany([
                [
                    'locale' => 'en',
                    'category_name' => $category,
                    'category_slug' => Str::slug($category, '-'),
                ],
                [
                    'locale' => 'hi',
                    'category_name' => $this->getHindiTranslation($category),
                    'category_slug' => Str::slug($this->getHindiTranslation($category), '-'),
                ]
            ]);
        }
    }

    /**
     * Get Hindi translations for category names.
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
            'Lifestyle' => 'जीवन शैली'
        ];

        return $translations[$englishName] ?? $englishName;
    }

}
