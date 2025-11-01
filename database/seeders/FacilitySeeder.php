<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Facility;

class FacilitySeeder extends Seeder
{
    public function run()
    {
        $facilities = ['Taman', 'Keamanan 24 jam', 'Masjid', 'Playground', 'Jogging Track'];

        foreach ($facilities as $f) {
            Facility::create(['name' => $f, 'description' => $f]);
        }
    }
}
