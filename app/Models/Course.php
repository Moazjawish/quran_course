<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;

    public function exams()
    {
        return $this->belongsTo(Exam::class);
    }

    public function courseFiles()
    {
        return $this->belongsTo(CourseFile::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_student');
    }

    public function instructors()
    {
        return $this->belongsToMany(Instructor::class, 'course_instrcutor');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
