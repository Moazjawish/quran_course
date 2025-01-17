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
        return $this->belongsTo(Exam::class, 'course_id');
    }

    public function courseFiles()
    {
        return $this->belongsTo(CourseFile::class, 'course_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class)->withTimestamps();
    }

    public function instructors()
    {
        return $this->belongsToMany(Instructor::class)->withTimestamps();
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
