<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentRecitation extends Model
{
    protected $guarded = [];
    protected $table = "student_recitation";
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'lesson_id');
    }
    public function students()
    {
        return $this->hasMany(Student::class, 'student_id');
    }
}
