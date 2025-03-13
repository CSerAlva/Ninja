<?php

namespace Database\Factories;

use App\Models\Dojo;
use App\Models\Ninja;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'ninja_id' => Ninja::inRandomOrder()->first()->id,
            'status' => 1,
            'dojo_id' => Dojo::inRandomOrder()->first()->id,
            'description' => fake()->paragraph(6)
        ];
    }
}
