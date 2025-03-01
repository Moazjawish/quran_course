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
            'start_date'  => '2025-08-01',
            'expected_end_date' => '2026-02-01',
        ]);
        Course::factory()->create([
            'title' => 'Biography',
            'start_date'  => '2025-08-20',
            'expected_end_date' => '2026-02-01',
        ]);
        Course::factory()->create([
            'title' => 'Tajweed',
            'start_date'  => '2025-09-01',
            'expected_end_date' => '2025-12-01',
        ]);
    }
}
