<?php

namespace Database\Factories;

use App\Models\Instructor;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TahfeezCourse>
 */
class TahfeezCourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => $this->faker->numberBetween(1, Student::count()),
            'instructor_id' => $this->faker->numberBetween(1, Instructor::count()),
            'group_join_date' => $this->faker->dateTime(),
        ];
    }
}
/*
student_id
instructor_id

 */
