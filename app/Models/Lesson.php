<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    /** @use HasFactory<\Database\Factories\LessonFactory> */
    use HasFactory;
    protected $guarded = [];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_lesson');
    }

    public function instructors()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }

    public function attendances()
    {
        return $this->belongsTo(Attendance::class, 'attendance_id');
    }
    public function studentRecitation()
    {
        return $this->belongsTo(StudentRecitation::class, 'lesson_id');
    }
}
