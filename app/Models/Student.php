<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    public function tahfeezCourse()
    {
        return $this->belongsTo(TahfeezCourse::class);
    }

    public function attendances()
    {
        return $this->belongsTo(Attendance::class);
    }
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student');
    }

    public function studentExams()
    {
        return $this->belongsTo(StudentExam::class);
    }


}
