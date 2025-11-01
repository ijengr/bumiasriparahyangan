<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $samples = [
            'samples/gallery1.jpg',
            'samples/gallery2.jpg',
            'samples/gallery3.jpg',
            'samples/gallery4.jpg',
            'samples/gallery5.jpg',
            'samples/gallery6.jpg',
            'samples/gallery7.jpg',
            'samples/gallery8.jpg',
            'samples/gallery9.jpg',
            'samples/gallery10.jpg',
        ];

        $now = now()->toDateTimeString();

        $rows = [];
        foreach ($samples as $index => $path) {
            $rows[] = [
                'path' => $path,
                'caption' => 'Gallery image '.($index+1),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        if (!empty($rows)) {
            DB::table('gallery_images')->insert($rows);
        }
    }
}
