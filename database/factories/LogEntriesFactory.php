<?php

namespace database\factories;

use App\Models\Dojo;
use App\Models\Ninja;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class LogEntriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->user_id(),
            'action' => fake()->action(),
            'description' => fake()->description(),
            'ip_address' => fake()->ip_address(),
            'user_agent' => fake()->user_agent(),
        ];
    }
}
