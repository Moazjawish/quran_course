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
        return $this->belongsTo(TahfeezCourse::class, 'instructor_id');
    }

    public function lessons()
    {
        return $this->belongsTo(Lesson::class, 'instructor_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class)->withTimestamps();
    }

    
}
