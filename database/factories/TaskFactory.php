<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'name' => $this->faker->word(30),
                'description' => $this->faker->realTextBetween($minNbChars = 20, $maxNbChars = 150),
                'user_id' => User::get()->random()->id,
        ];
    }
}
