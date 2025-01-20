<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
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
            'instructor_id' => $this->faker->numberBetween(1, Instructor::count()),
            'lesson_title'=> 'lesson_title'.$this->faker->numberBetween(1,20),
            'lesson_date' => $this->faker->date(),
            'is_tahfeez_course' => false,
        ];
    }
}



