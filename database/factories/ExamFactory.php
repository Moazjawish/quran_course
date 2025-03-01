<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exam>
 */
class ExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => $this->faker->numberBetween(1, Course::count()),
            'exam_date' => $this->faker->date(),
            'max_mark'  => $this->faker->randomElement([100,200]),
            'passing_mark'  => $this->faker->randomElement([100,200]),
        ];
    }
}
