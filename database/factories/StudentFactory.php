<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $certificates = $this->faker->randomElement(['Primary stage', 'Secondary Stage', 'Preparatory stage']);
        $quran_parts  = $this->faker->randomElement([1, 2, 4, 8, 10]);
        $quran_passed_parts  = $this->faker->randomElement([1, 2, 4, 0, 10]);
        return [
            'name'=> $this->faker->name(),
            'email'=> $this->faker->email(),
            'password'=> $this->faker->password(),
            'certificate'=> $certificates,
            'student_img'=> $this->faker->image(),
            'birth_date'=> $this->faker->date(),
            'quran_memorized_parts'=> $quran_parts,
            'phone_number'=> $this->faker->phoneNumber(),
            'quran_passed_parts'=> $quran_passed_parts,
            'address' => $this->faker->address(),
            'enroll_date' => $this->faker->date(),
        ];
    }
}
/*






 */
