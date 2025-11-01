<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    public function run()
    {
        Unit::create([
            'title' => 'Rumah Type A',
            'type' => 'Type A',
            'land_area' => 120,
            'floor_area' => 90,
            'bedrooms' => 3,
            'bathrooms' => 2,
            'parking' => 1,
            'built_year' => 2022,
            'price' => 750000000,
            'image' => 'samples/unit1.svg',
            'description' => 'Rumah nyaman dengan taman depan.'
        ]);

        Unit::create([
            'title' => 'Rumah Type B',
            'type' => 'Type B',
            'land_area' => 150,
            'floor_area' => 120,
            'bedrooms' => 4,
            'bathrooms' => 3,
            'parking' => 2,
            'built_year' => 2021,
            'price' => 950000000,
            'image' => 'samples/unit2.svg',
            'description' => 'Rumah luas dengan area service.'
        ]);

        // Additional sample units
        Unit::create([
            'title' => 'Kavling Siap Bangun',
            'type' => 'Kavling',
            'land_area' => 200,
            'floor_area' => null,
            'bedrooms' => null,
            'bathrooms' => null,
            'parking' => null,
            'built_year' => null,
            'price' => 550000000,
            'image' => 'samples/unit1.svg',
            'description' => 'Tanah kavling cocok untuk membangun rumah impian Anda.'
        ]);

        Unit::create([
            'title' => 'Rumah Modern 2 Lantai',
            'type' => 'Type C',
            'land_area' => 180,
            'floor_area' => 160,
            'bedrooms' => 4,
            'bathrooms' => 3,
            'parking' => 2,
            'built_year' => 2023,
            'price' => 1250000000,
            'image' => 'samples/unit2.svg',
            'description' => 'Desain modern dua lantai dengan taman belakang.'
        ]);

        // create a few random units using factory if available
        if (class_exists(\Database\Factories\UnitFactory::class)) {
            Unit::factory()->count(5)->create();
        }

        // Additional units that reference gallery sample images to ensure unique visuals
        $extra = [
            ['title' => 'Rumah Lestari', 'image' => 'samples/gallery1.jpg'],
            ['title' => 'Rumah Sakinah', 'image' => 'samples/gallery2.jpg'],
            ['title' => 'Rumah Harmoni', 'image' => 'samples/gallery3.jpg'],
            ['title' => 'Rumah Ceria', 'image' => 'samples/gallery4.jpg'],
            ['title' => 'Rumah Anggun', 'image' => 'samples/gallery5.jpg'],
            ['title' => 'Rumah Bahagia', 'image' => 'samples/gallery6.jpg'],
            ['title' => 'Rumah Sejuk', 'image' => 'samples/gallery7.jpg'],
            ['title' => 'Rumah Mandiri', 'image' => 'samples/gallery8.jpg'],
            ['title' => 'Rumah Cerah', 'image' => 'samples/gallery9.jpg'],
            ['title' => 'Rumah Indah', 'image' => 'samples/gallery10.jpg'],
        ];

        foreach ($extra as $i => $u) {
            Unit::create([
                'title' => $u['title'],
                'type' => 'Type X',
                'land_area' => 100 + ($i * 10),
                'floor_area' => 80 + ($i * 8),
                'bedrooms' => 2 + ($i % 3),
                'bathrooms' => 1 + ($i % 2),
                'parking' => 1,
                'built_year' => 2020 + ($i % 4),
                'price' => 600000000 + ($i * 50000000),
                'image' => $u['image'],
                'description' => 'Unit contoh '.($i+1).', cocok untuk keluarga.'
            ]);
        }
    }
}
