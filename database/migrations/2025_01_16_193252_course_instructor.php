<?php

use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('course_instrutor', function (Blueprint $table) {
            $table->id();
            $table->foreignId(Course::class , 'course_id');
            $table->foreignId(Instructor::class , 'instructor_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
