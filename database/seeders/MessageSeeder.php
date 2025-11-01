<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;
use Illuminate\Support\Str;

class MessageSeeder extends Seeder
{
    public function run()
    {
        // Create 10 realistic contact messages
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 10; $i++) {
            Message::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'subject' => $faker->sentence(6),
                'phone' => $faker->e164PhoneNumber,
                'message' => $faker->paragraphs(rand(1,3), true),
            ]);
        }
    }
}
