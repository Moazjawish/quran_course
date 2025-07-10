<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;

    protected $guarded = [];
    public function exams()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function courseFiles()
    {
        return $this->hasMany(CourseFile::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_student','course_id','student_id');
    }

    public function instructors()
    {
        return $this->belongsToMany(Instructor::class, 'course_instrcutor');
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class);
    }
}
