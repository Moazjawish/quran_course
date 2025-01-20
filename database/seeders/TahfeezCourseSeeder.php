<?php

namespace Database\Seeders;

use App\Models\TahfeezCourse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TahfeezCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TahfeezCourse::factory(20)->create();
    }
}
