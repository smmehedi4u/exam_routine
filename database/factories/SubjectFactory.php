<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "course_name" => fake()->name(),
            "course_code" => rand(101, 899),
            "year" => rand(1, 4),
            "semester" => rand(1, 2),
            "department_id" => rand(1, 3)
        ];
    }
}
