<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            "title"=> fake()->sentence(3),
            "description"=>fake()->paragraph(4),
            "url"=>fake()->url(),
            "start"=> fake()->date(),
            "end" => fake()->date()
        ];
    }
}
