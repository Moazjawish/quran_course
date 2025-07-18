<?php

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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->string("certificate");
            $table->string("student_img");
            $table->date("birth_date");
            $table->string("quran_memorized_parts")->nullable();
            $table->string("quran_passed_parts")->nullable();
            $table->string("phone_number");
            $table->string("address");
            $table->date("enroll_date");
            $table->string('reset_password_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
