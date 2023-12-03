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
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'user_id' => 1,
            'start' => $this->faker->dateTimeBetween('2023-12-01', '2023-12-31'),
            'end'   => $this->faker->dateTimeBetween('2023-12-01', '2023-12-31')
        ];
    }
}
