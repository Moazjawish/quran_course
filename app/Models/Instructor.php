<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    /** @use HasFactory<\Database\Factories\InstructorFactory> */
    use HasFactory;
    public function tahfeezCourse()
    {
        return $this->belongsTo(TahfeezCourse::class);
    }

    public function lessons()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_instrcutor');
    }


}
