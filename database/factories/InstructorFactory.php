<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Alirezasedghi\LaravelImageFaker\ImageFaker;
use Alirezasedghi\LaravelImageFaker\Services\Picsum;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Instructor>
 */
class InstructorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $image_faker = new ImageFaker(new Picsum());

        $certificates = $this->faker->randomElement(['Software_Enginner', 'Doctor', 'Student']);
        $quran_parts  = $this->faker->randomElement([1, 2, 4, 8, 30]);
        $quran_passed_parts  = $this->faker->randomElement([1, 2, 4, 0, 10]);
        $religious_qualifications =$this->faker->randomElement(['Jurisprudence', 'Biography', 'Tajweed']);

        return [
            'name'=> $this->faker->name(),
            'email'=> $this->faker->email(),
            'password'=> $this->faker->password(),
            'certificate'=> $certificates,
            'instructor_img'=>$image_faker->image(storage_path('/app')),
            'phone_number'=> $this->faker->phoneNumber(),
            'quran_memorized_parts'=> $quran_parts,
            'quran_passed_parts'=> $quran_passed_parts,
            'religious_qualifications'=> $religious_qualifications,
            'address' => $this->faker->address(),
            'birth_date'=> $this->faker->date(),
            'role' =>  $this->faker->randomElement(['instructor', 'admin']),
            // 'is_admin'=> false,
        ];
    }
}
