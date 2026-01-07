<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            [
                'translations' => [
                    ['locale' => 'en', 'city_name' => 'New York'],
                    ['locale' => 'hi', 'city_name' => 'न्यूयॉर्क']
                ]
            ],
            [
                'translations' => [
                    ['locale' => 'en', 'city_name' => 'Los Angeles'],
                    ['locale' => 'hi', 'city_name' => 'लॉस एंजेलिस']
                ]
            ],
            [
                'translations' => [
                    ['locale' => 'en', 'city_name' => 'Chicago'],
                    ['locale' => 'hi', 'city_name' => 'शिकागो']
                ]
            ]
        ];

        foreach ($cities as $cityData) {
            $city = City::create();
            $city->translations()->createMany($cityData['translations']);
        }
    }
}
