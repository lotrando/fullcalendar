<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\User;
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
            'title'         => $this->faker->name(),
            'user_id'       => User::all()->random()->id,
            'department_id' => Department::all()->random()->id,
            'start'         => $this->faker->dateTimeBetween('2023-10-15', '2023-12-15'),
            'end'           => $this->faker->dateTimeBetween('2023-10-15', '2023-12-15')
        ];
    }
}
