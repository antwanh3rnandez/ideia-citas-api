<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Citas>
 */
class CitasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $contacted = rand(0, 1);
        $answer = ($contacted == 1) ? rand(0, 1) : 0;
        
        return [
            'uid_manychat' => fake()->sentence,
            'name' => fake()->sentence,
            'phone' => fake()->sentence,
            'day' => fake()->sentence,
            'hour' => fake()->sentence,
            'contacted' => $contacted,
            'answer' => $answer
        ];
    }
}
