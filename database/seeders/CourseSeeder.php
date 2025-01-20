<?php

namespace Database\Seeders;
use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /*
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::factory()->create([
            'title' => 'Jurisprudence',
            'course_start_date'  => '2025-08-01 00:00:00',
            'course_expire_date' => '2026-02-01 00:00:00',
        ]);
        Course::factory()->create([
            'title' => 'Biography',
            'course_start_date'  => '2025-08-20 00:00:00',
            'course_expire_date' => '2026-02-01 00:00:00',
        ]);
        Course::factory()->create([
            'title' => 'Tajweed',
            'course_start_date'  => '2025-09-01 00:00:00',
            'course_expire_date' => '2025-12-01 00:00:00',
        ]);
    }
}
