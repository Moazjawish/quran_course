<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    /** @use HasFactory<\Database\Factories\AttendanceFactory> */
    use HasFactory;
    protected $guarded = [];
    public function lessons()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function instructors()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }
}
