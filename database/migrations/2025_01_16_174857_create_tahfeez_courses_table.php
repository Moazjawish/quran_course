<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Student;
use App\Models\Instructor;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tahfeez_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id', Student::class);
            $table->foreignId('instructor_id', Instructor::class);
            $table->dateTime("group_join_date")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tahfeez_courses');
    }
};
