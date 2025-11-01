<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Message::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'subject' => $this->faker->sentence(6),
            'phone' => $this->faker->e164PhoneNumber(),
            'message' => $this->faker->paragraph(),
            'is_read' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
