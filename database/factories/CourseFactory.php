<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $course_title =$this->faker->randomElement(['Jurisprudence', 'Biography', 'Tajweed' , 'tahfeez']);

        return [
            'title' => $course_title,
            'course_start_date' => $this->faker->date(),
            'course_expire_date' => $this->faker->date(),
        ];
    }
}
